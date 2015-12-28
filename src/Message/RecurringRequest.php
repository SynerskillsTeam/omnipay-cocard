<?php
/**
 * Cocard Recurring Request
 */

namespace Omnipay\Cocard\Message;

class RecurringRequest extends PurchaseRequest
{
    public function setPlanId($value)
    {
        return $this->setParameter('planId', $value);
    }

    public function getPlanId()
    {
        return $this->getParameter('planId');
    }

    public function getData()
    {
        $this->validate('amount');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'currency' => $this->getCurrency(),
            'billing' => $this->getBilling(),
            'shipping' => $this->getShipping(),
            'merchant-defined-field-1' => 'test1',
        ];

        /**
         * start-date, po-number, customer-vault-id, order-id, order-description,
         * merchant-defined-field-x, tax-amount, shipping-amount
         */
        if ($base = $this->getBaseData()) {
            $base_keys = [
                'start-date', 'po-number', 'customer-vault-id', 'order-id',
                'order-description', 'tax-amount', 'shipping-amount'
            ];
            foreach ($base_keys as $bk) {
                if (isset($base[$bk])) {
                    $array[$bk] = $base[$bk];
                }
            }
        }

        if ($plan_id = $this->getPlanId()) {
            //to existing plan
            $array['plan'] = ['plan-id' => $plan_id];
        } else {
            //to a custom  plan
            $array['plan'] = [
                'payments' => '0',
                'amount' => $this->getAmount(),
                'day-frequency' => '',
                'month-frequency' => '1',
                'day-of-month' => '1',
            ];
        }
        return $array;
    }

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'add-subscription');
    }
}
