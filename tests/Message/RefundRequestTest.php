<?php

namespace Omnipay\Cocard\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    /**
     * @var \Omnipay\Cocard\Message\RefundRequest
     */
    var $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '12.00',
                'transactionId' => '0987654345678900987654',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('12.00', (string)$data['amount']);
        $this->assertSame('0987654345678900987654', (string)$data['transaction-id']);
    }

}
