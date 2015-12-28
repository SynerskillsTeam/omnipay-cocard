<?php
/**
 * Cocard Capture Request
 */

namespace Omnipay\Cocard\Message;

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

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'capture');
    }
}
