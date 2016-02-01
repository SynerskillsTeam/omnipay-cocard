<?php
/**
 * Cocard DeleteBilling Request
 */

namespace Omnipay\Cocard\Message;

class DeleteBillingRequest extends PurchaseRequest
{

    public function setBillingId($value)
    {
        return $this->setParameter('billing-id', $value);
    }

    public function getBillingId()
    {
        return $this->getParameter('billing-id');
    }

    public function getData()
    {
        $this->validate('billing-id');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'billing' => ['billing-id' => $this->getBillingId()],
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

    public function sendData($data, $root = 'delete-billing')
    {
        return parent::sendData($data, $root);
    }
}
