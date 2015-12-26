<?php
/**
 * Cocard Refund Request
 */

namespace Omnipay\Cocard\Message;

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

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'refund');
    }
}
