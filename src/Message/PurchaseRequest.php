<?php
/**
 * Cocard Purchase Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class PurchaseRequest extends AbstractRequest
{
    public function setBilling($value)
    {
        $this->setParameter('billing', $value);
    }

    public function getBilling()
    {
        return $this->getParameter('billing');
    }

    public function setShipping($value)
    {
        $this->setParameter('shipping', $value);
    }

    public function getShipping()
    {
        return $this->getParameter('shipping');
    }

    public function getData()
    {
        $this->validate('amount');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'amount' => $this->getAmount(),
            'ip-address' => $this->getClientIp(),
            'currency' => $this->getCurrency(),
            'order-id' => '1234',
            'order-description' => '',
            'merchant-defined-field-1' => 'test1',
            'merchant-defined-field-2' => 'test2',
            'tax-amount' => 0.00,
            'shipping-amount' => 0.00,
            'customer-id' => 123456,
            'customer-vault-id' => '11111',
            'billing' => $this->getBilling(),
            'shipping' => $this->getShipping(),
        ];

        foreach($this->getItems() as $item){
            $array['product'][] = $item;
        }
        return $array;
    }

    public function sendData($data)
    {

        $xmlDom = Array2XML::createXML('sale', $this->getData());

        // post to Cocard
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();

        return $this->response = new PurchaseResponse($this, $httpResponse->getBody(true));
    }
}
