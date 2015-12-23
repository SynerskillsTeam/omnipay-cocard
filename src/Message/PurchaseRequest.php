<?php
/**
 * Cocard Purchase Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => 'http://omnipay_demo.cc/test_complete',
            'amount' => $this->getAmount(),
            'ip-address' => $this->getClientIp(),
            'currency' => 'USD',
            'order-id' => '1234',
            'order-description' => '',
            'merchant-defined-field-1' => 'test1',
            'merchant-defined-field-2' => 'test2',
            'tax-amount' => 0.00,
            'shipping-amount' => 0.00,
            'customer-vault-id' => '11111',
            'billing' => [
                [
                    'first-name' => 'Henter',
                    'last-name' => 'Chow',
                    'address1' => 'Huangpu District',
                    'address2' => 'xxx',
                    'city' => 'Shanghai',
                    'state' => 'Shanghai',
                    'postal' => '1234',
                    'country' => 'CN',
                    'email' => 'henter@henter.me',
                    'phone' => '55555555',
                    'company' => 'hc',
                    'fax' => '55555'
                ],
            ],
            'shipping' => [
                [
                    'first-name' => 'Henter',
                    'last-name' => 'Chow',
                    'address1' => 'Huangpu District',
                    'address2' => 'xxx',
                    'city' => 'Shanghai',
                    'state' => 'Shanghai',
                    'postal' => '1234',
                    'country' => 'CN',
                    'phone' => '55555555',
                    'company' => 'hc',
                ],
            ],
            'product' => [
                [
                    'product-code' => 'SKU-123',
                    'description' => 'test',
                    'commodity-code' => 'abc',
                    'unit-of-measure' => 'lbs',
                    'unit-cost' => '5.00',
                    'quantity' => 1,
                    'total-amount' => 7.22,
                    'tax-amount' => 0.00,
                    'tax-rate' => 1.00,
                    'discount-amount' => 1.00,
                    'discount-rate' => 1.00,
                    'tax-type' => 'sales',
                    'alternate-tax-id' => '12345'
                ],
                [
                    'product-code' => 'SKU-12345',
                    'description' => 'test',
                    'commodity-code' => 'abc',
                    'unit-of-measure' => 'lbs',
                    'unit-cost' => '5.00',
                    'quantity' => 1,
                    'total-amount' => 7.22,
                    'tax-amount' => 0.00,
                    'tax-rate' => 1.00,
                    'discount-amount' => 1.00,
                    'discount-rate' => 1.00,
                    'tax-type' => 'sales',
                    'alternate-tax-id' => '12345'
                ],
            ]
        ];
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
