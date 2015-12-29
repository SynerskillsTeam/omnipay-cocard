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
        $this->gateway->setApiKey('2F822Rw39fx762MaV7Yy86jXGTC7sCDy');

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

    /*
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

    public function testAddCustomer()
    {
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'billing' => [
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
            'shipping' => [
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
        );

        //$this->setMockHttpResponse('CustomerSuccess.txt');

        $response = $this->gateway->addCustomer($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Customer Added', $response->getText());


    }
    */

    public function testUpdateCustomer()
    {
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'baseData' => [
                'customer-vault-id' => '11105',
            ],
            'billing' => [
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
            'shipping' => [
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
        );

        //$this->setMockHttpResponse('CustomerSuccess.txt');

        $response = $this->gateway->updateCustomer($options)->send();
        //var_dump($response->getData(), 333);exit;
        //TODO
        return false;

        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Customer Added', $response->getText());
    }
}
