<?php
/**
 * Cocard Authorize Request
 */

namespace Omnipay\Cocard\Message;

class AuthorizeRequest extends PurchaseRequest
{

    public function sendData($data, $root = 'auth')
    {
        return parent::sendData($data, $root);
    }
}
