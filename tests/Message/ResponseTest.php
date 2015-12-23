<?php

namespace Omnipay\Cocard\Message;

use Mockery as m;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{

    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody(true));

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('2924647560', $response->getTransactionReference());
        $this->assertSame('1', $response->getResult());
        $this->assertSame('100', $response->getCode());
        $this->assertSame('Transaction was approved.', $response->getMessage());
        $this->assertSame('Step 1 completed', $response->getText());
        $this->assertEmpty($response->getRedirectUrl());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody(true));

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('3', $response->getResult());
        $this->assertSame(null, $response->getTransactionReference());
        $this->assertSame('Transaction was rejected by gateway.', $response->getMessage());
        $this->assertSame('Transaction not found REFID:3171995699', $response->getText());
    }
}
