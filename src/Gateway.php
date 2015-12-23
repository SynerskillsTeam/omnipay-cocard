<?php

namespace Omnipay\Cocard;

use Omnipay\Cocard\Message\CompletePurchaseRequest;
use Omnipay\Cocard\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;

/**
 * Cocard Gateway
 *
 * @link https://secure.cocardgateway.com/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Cocard';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
        );
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Capture Request
     *
     * Use this request to capture and process a previously created authorization.
     *
     * @param  array $parameters
     * @return \Omnipay\Cocard\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cocard\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cocard\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cocard\Message\CompletePurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cocard\Message\RefundRequest', $parameters);
    }
}
