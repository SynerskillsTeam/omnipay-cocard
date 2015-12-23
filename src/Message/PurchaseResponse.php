<?php

namespace Omnipay\Cocard\Message;

/**
 * Cocard Purchase Response
 */
class PurchaseResponse extends Response
{
    public function isSuccessful()
    {
        return 1 === (int) $this->getResult() && isset($this->data['form-url']);
    }
}
