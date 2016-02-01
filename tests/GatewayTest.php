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

    public function testAddPlan()
    {
        $plan = [
            'payments' => '0',
            'name' => 'testplan',
            'plan-id' => '123456',
            //'day-frequency' => '',
            'month-frequency' => '2',
            'day-of-month' => '1'
        ];
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'amount' => '222.12',
            'plan' => $plan,
        );

        $this->setMockHttpResponse('AddPlanSuccess.txt');

        $response = $this->gateway->addPlan($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('Plan Added', $response->getText());

        foreach($plan as $k=>$v){
            $this->assertEquals($v, $response->getData()['plan'][$k]);
        }
    }

    public function testAddBilling()
    {
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'baseData' => [
                'customer-vault-id' => '652322643',
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
        );

        $this->setMockHttpResponse('AddBillingSuccess.txt');

        $response = $this->gateway->addBilling($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Billing Information Added', $response->getText());
    }

    public function testUpdateBilling()
    {
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'baseData' => [
                'customer-vault-id' => '652322643',
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
        );

        $this->setMockHttpResponse('UpdateBillingSuccess.txt');

        $response = $this->gateway->updateBilling($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Billing Information Updated', $response->getText());
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

        $this->setMockHttpResponse('AddCustomerSuccess.txt');

        $response = $this->gateway->addCustomer($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Customer Added', $response->getText());


    }

    public function testUpdateCustomer()
    {
        $options = array(
            'returnUrl' => 'https://www.example.com/return',
            'baseData' => [
                'customer-vault-id' => '652322643',
            ],
            'billing' => [
                'first-name' => 'HenterTestUpdate',
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
                'first-name' => 'HenterTestUpdate',
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

        $this->setMockHttpResponse('UpdateCustomerSuccess.txt');

        $response = $this->gateway->updateCustomer($options)->send();

        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('form-url', $response->getData());
        $this->assertEquals('Customer Update Successful', $response->getText());
    }

    public function testDeleteCustomer()
    {
        $options = [
            'baseData' => [
                'customer-vault-id' => '1525672784_not_exists'
            ]
        ];

        //test error result
        $response = $this->gateway->deleteCustomer($options)->send();
        $this->assertInstanceOf('\Omnipay\Cocard\Message\Response', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertStringStartsWith('Invalid Customer Vault Id', $response->getText());
        $this->assertEquals(300, $response->getCode());

        //test success result
        $this->setMockHttpResponse('DeleteCustomerSuccess.txt');
        $response = $this->gateway->deleteCustomer($options)->send();
        $this->assertEquals('Customer Deleted', $response->getText());
        $this->assertEquals(100, $response->getCode());
    }
}
