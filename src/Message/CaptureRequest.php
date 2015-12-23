<?php
/**
 * Cocard Capture Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class CaptureRequest extends AbstractRequest
{

    //TODO, need fix fields
    public function getData()
    {
        $this->validate('transactionId', 'amount');

        return [
            'api-key' => $this->getApiKey(),
            'transaction-id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'merchat-defined-field-1' => 'test1',
            'merchat-defined-field-2' => 'test2',
            'tracking-number' => '123',
            'shipping-carrier' => 'ups',
            'order-id' => '12345'
        ];
    }

    public function sendData($data)
    {
        $xmlDom = Array2XML::createXML('capture', $this->getData());
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();

        return $this->response = new Response($this, $httpResponse->getBody(true));
    }
}
