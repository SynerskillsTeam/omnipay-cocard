<?php
/**
 * Cocard Refund Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class RefundRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('transactionId', 'amount');

        return [
            'api-key' => $this->getApiKey(),
            'transaction-id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
        ];
    }

    public function sendData($data)
    {
        $xmlDom = Array2XML::createXML('refund', $this->getData());
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();
        return $this->response = new CaptureResponse($this, $httpResponse->getBody(true));
    }
}
