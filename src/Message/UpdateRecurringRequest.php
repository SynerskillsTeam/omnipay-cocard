<?php
/**
 * Cocard UpdateRecurring Request
 */

namespace Omnipay\Cocard\Message;


class UpdateRecurringRequest extends AbstractRequest
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
            'redirect-url' => 'http://omnipay_demo.cc/test_complete',
            'subscription-id' => $this->getSubscriptionId(),
            'order-id' => '1234',
            'order-description' => '',
            'po-number' => '',
            'currency' => 'USD',
            'merchant-defined-field-1' => 'test1',
            'merchant-defined-field-2' => 'test2',
            'billing' => [
                [
                    'first-name' => 'Henter',
                    'last-name' => 'Chow',
                    'address1' => 'Huangpu District',
                    'address2' => 'xxx',
                    'city' => 'Shanghai',
                    'state' => 'Shanghai',
                    'postal' => '1234',
                    'country' => 'CN',
                    'email' => 'henter@henter.me',
                    'phone' => '55555555',
                    'company' => 'hc',
                    'fax' => '55555',
                    'account-type' => 'checking',
                    'entity-type' => 'personal'
                ],
            ],
            'shipping' => [
                [
                    'shpping-id'=> 123,
                    'first-name' => 'Henter',
                    'last-name' => 'Chow',
                    'address1' => 'Huangpu District',
                    'address2' => 'xxx',
                    'city' => 'Shanghai',
                    'state' => 'Shanghai',
                    'postal' => '1234',
                    'country' => 'CN',
                    'phone' => '55555555',
                    'company' => 'hc',
                    'fax' => '5555'
                ],
            ],
        ];

        return $array;
    }

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'update-subscription');
    }
}
