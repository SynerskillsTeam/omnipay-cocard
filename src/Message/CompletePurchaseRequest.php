<?php

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class CompletePurchaseRequest extends PurchaseRequest
{

    public function getData()
    {
        $this->validate('token');
        return [
            'api-key' => $this->getApiKey(),
            'token-id' => $this->getParameter('token')
        ];
    }

    public function sendData($data)
    {

        $xmlDom = Array2XML::createXML('complete-action', $this->getData());

        // post to Cocard
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();

        return $this->response = new Response($this, $httpResponse->getBody(true));
    }

}
