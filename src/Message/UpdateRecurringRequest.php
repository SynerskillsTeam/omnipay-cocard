<?php
/**
 * Cocard UpdateRecurring Request
 */

namespace Omnipay\Cocard\Message;

class UpdateRecurringRequest extends RecurringRequest
{
    public function setSubscriptionId($value)
    {
        return $this->setParameter('subscriptionId', $value);
    }

    public function getSubscriptionId()
    {
        return $this->getParameter('subscriptionId');
    }

    public function getData()
    {
        $this->validate('subscriptionId');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'subscription-id' => $this->getSubscriptionId(),
            'currency' => $this->getCurrency(),
            'billing' => $this->getBilling(),
            'shipping' => $this->getShipping(),
            //'merchant-defined-field-1' => 'test1',
        ];

        //po-number, order-id, order-description, merchant-defined-field-x
        if ($base = $this->getBaseData()) {
            $base_keys = ['po-number', 'order-id', 'order-description'];
            foreach ($base_keys as $bk) {
                if (isset($base[$bk])) {
                    $array[$bk] = $base[$bk];
                }
            }
        }

        return $array;
    }

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'update-subscription');
    }
}
