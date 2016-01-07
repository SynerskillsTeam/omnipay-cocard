<?php
/**
 * Cocard DeleteCustomer Request
 */

namespace Omnipay\Cocard\Message;

class DeleteCustomerRequest extends AddCustomerRequest
{

    public function getData()
    {
        $array = [
            'api-key' => $this->getApiKey(),
            'customer-vault-id' => $this->getBaseData()['customer-vault-id']
        ];

        return $array;
    }

    public function sendData($data, $root = 'delete-customer')
    {
        return parent::sendData($data, $root);
    }
}
