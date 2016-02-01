<?php
/**
 * Cocard AddBilling Request
 */

namespace Omnipay\Cocard\Message;

class AddBillingRequest extends PurchaseRequest
{

    public function getData()
    {
        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'billing' => $this->getBilling(),
        ];

        //customer-vault-id, merchant-defined-field-x
        if ($base = $this->getBaseData()) {
            $base_keys = ['customer-vault-id'];
            foreach ($base_keys as $bk) {
                if (isset($base[$bk])) {
                    $array[$bk] = $base[$bk];
                }
            }
        }

        if (!isset($array['customer-vault-id'])) {
            throw new \Exception('parameter error: customer-vault-id');
        }

        return $array;
    }

    public function sendData($data, $root = 'add-billing')
    {
        return parent::sendData($data, $root);
    }
}
