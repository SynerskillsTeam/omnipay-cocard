<?php
/**
 * Cocard UpdateCustomer Request
 */

namespace Omnipay\Cocard\Message;

class UpdateCustomerRequest extends AddCustomerRequest
{

    public function sendData($data, $root = 'update-customer')
    {
        return parent::sendData($data, $root);
    }
}
