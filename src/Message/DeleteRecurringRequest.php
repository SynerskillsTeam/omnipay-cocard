<?php
/**
 * Cocard DeleteRecurring Request
 */

namespace Omnipay\Cocard\Message;

class DeleteRecurringRequest extends RecurringRequest
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
            'subscription-id' => $this->getSubscriptionId(),
        ];

        return $array;
    }

    public function sendData($data, $root = 'delete-subscription')
    {
        return parent::sendData($data, $root);
    }
}
