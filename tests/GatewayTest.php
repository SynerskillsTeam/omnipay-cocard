<?php

namespace Omnipay\Cocard;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var \Omnipay\Cocard\Gateway
     */
    var $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $products = [
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
            ]
        ];
        $this->options = array(
            'amount' => '10.00',
            'returnUrl' => 'https://www.example.com/return',
            'cilentIp' => '127.0.0.1',
            'products' => $products,
            'card' => new CreditCard(array(
                'firstName' => 'Example',
                'lastName' => 'User',
                'number' => '4111111111111111',
                'expiryMonth' => '12',
                'expiryYear' => '2016',
                'cvv' => '123',
                'issueNumber' => '5',
                'startMonth' => '4',
                'startYear' => '2013',
            )),
        );
    }

    public function testPurchase()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('2924647560', $response->getTransactionReference());
    }

    public function testPurchaseError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('300', $response->getCode());
        $this->assertSame('Transaction was rejected by gateway.', $response->getMessage());
    }
}
