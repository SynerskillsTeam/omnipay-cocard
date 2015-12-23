<?php
/**
 * Cocard Card Request
 */

namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

/**
 * Cocard Card Request
 *
 * <code>
 *   $transaction = $gateway->purchase(array(
 *       'card'        => Card Object,
 *       'form-url'      => 'https://secure.cocardgateway.com/api/v2/three-step/644q2t85',
 *   ));
 *   $transaction->setTransactionReference($auth_id);
 *   $response = $transaction->send();
 * </code>
 */
class CardRequest extends AbstractRequest
{


    public function getFormUrl()
    {
        $this->getParameter('formUrl');
    }

    public function setFormUrl($value)
    {
        return $this->setParameter('formUrl', $value);
    }


    public function getData()
    {
        $this->validate('card', 'formUrl');
        $this->getCard()->validate();

        $this->setEndpoint($this->getParameter('formUrl'));

        return [
            'billing-cc-number' => $this->getCard()->getNumber(),
            'billing-cc-exp' => $this->getCard()->getExpiryDate('my'),
            'cvv' => $this->getCard()->getCvv(),
        ];
    }

    public function sendData($data)
    {
        // post to Cocard
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $this->getData())->send();

        return $this->response = new PurchaseResponse($this, $httpResponse->getBody(true));
    }
}
