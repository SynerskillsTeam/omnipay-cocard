<?php
/**
 * Cocard AddCustomer Request
 */

namespace Omnipay\Cocard\Message;

class AddCustomerRequest extends PurchaseRequest
{

    public function getData()
    {
        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'billing' => $this->getBilling(),
            'shipping' => $this->getShipping(),
        ];

        //customer-vault-id, merchant-defined-field-x
        if ($base = $this->getBaseData()) {
            $base_keys = ['customer-vault-id', 'merchant-defined-field-1'];
            foreach ($base_keys as $bk) {
                if (isset($base[$bk])) {
                    $array[$bk] = $base[$bk];
                }
            }
        }

        return $array;
    }

    public function sendData($data, $root = 'add-customer')
    {
        return parent::sendData($data, $root);
    }
}
