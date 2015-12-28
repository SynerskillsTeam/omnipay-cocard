<?php
/**
 * Cocard UpdateCustomer Request
 */

namespace Omnipay\Cocard\Message;

class UpdateCustomerRequest extends PurchaseRequest
{

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'update-customer');
    }
}
