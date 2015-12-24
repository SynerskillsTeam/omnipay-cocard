<?php
/**
 * Cocard Recurring Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

class RecurringRequest extends AbstractRequest
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
            'redirect-url' => 'http://omnipay_demo.cc/test_complete',
            'customer-vault-id' => '11111',
            'start-date' => '20151224',
            'order-id' => '1234',
            'order-description' => '',
            'po-number' => '',
            'currency' => 'USD',
            'tax-amount' => 0.00,
            'shipping-amount' => 0.00,
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

        if ($plan_id = $this->getPlanId()) {
            //to existing plan
            $array['plan'] = ['plan-id' => $plan_id];
        } else {
            //to a custom  plan
            $array['plan'] = [
                'payments' => '123',
                'amount' => $this->getAmount(),
                'day-frequency' => '',
                'month-frequency' => '1',
                'day-of-month' => '1',
            ];
        }
        return $array;
    }

    public function sendData($data)
    {
        $xmlDom = Array2XML::createXML('add-subscription', $this->getData());

        // post to Cocard
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();

        return $this->response = new PurchaseResponse($this, $httpResponse->getBody(true));
    }
}
