<?php
/**
 * Cocard AddPlan Request
 */

namespace Omnipay\Cocard\Message;

class AddPlanRequest extends PurchaseRequest
{
    public function setPlan($value)
    {
        $required_keys = [
            'payments',
            'name',
            'plan-id',
        ];

        foreach ($required_keys as $rk) {
            if (!isset($value[$rk])) {
                throw new \Exception("plan key error: ".$rk);
            }
        }

        if (!isset($value['day-frequency']) && !isset($value['month-frequency']) && !isset($value['day-of-month'])) {
            throw new \Exception("plan frenquency error");
        }
        return $this->setParameter('plan', $value);
    }

    public function getPlan()
    {
        return $this->getParameter('plan');
    }

    public function getData()
    {
        $this->validate('amount', 'plan');

        $plan = $this->getPlan();
        $plan['amount'] = $this->getAmount();

        $array = [
            'api-key' => $this->getApiKey(),
            'plan' => $plan,
        ];
        return $array;
    }

    public function sendData($data, $root = 'add-plan')
    {
        return parent::sendData($data, $root);
    }
}
