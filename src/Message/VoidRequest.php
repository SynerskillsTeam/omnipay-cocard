<?php
/**
 * Cocard Void Request
 */

namespace Omnipay\Cocard\Message;

class VoidRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('transactionId');

        return [
            'api-key' => $this->getApiKey(),
            'transaction-id' => $this->getTransactionId(),
            'merchant-defined-field-1' => 'test',
        ];
    }

    public function sendData($data, $root = 'void')
    {
        return parent::sendData($data, $root);
    }
}
