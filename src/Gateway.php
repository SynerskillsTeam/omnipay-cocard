<?php
/**
 * Cocard Gateway
 *
 * @author Henter <henter@henter.me>
 * @date   2015-12-17
 */

namespace Omnipay\Cocard;

/**
 * Cocard Gateway
 *
 * @link https://secure.cocardgateway.com/
 */
class Gateway extends \Omnipay\Common\AbstractGateway
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
     * @param  array $parameters
     * @return \Omnipay\Cocard\Message\CaptureRequest
     */
    public function capture(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\CaptureRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\CompleteRequest
     */
    public function complete(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\CompleteRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\RefundRequest
     */
    public function refund(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\RefundRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\RecurringRequest
     */
    public function recurring(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\RecurringRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\UpdateRecurringRequest
     */
    public function updateRecurring(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\RecurringRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\AddCustomerRequest
     */
    public function addCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\AddCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\UpdateCustomerRequest
     */
    public function updateCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\UpdateCustomerRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\DeleteCustomerRequest
     */
    public function deleteCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\DeleteCustomerRequest', $parameters);
    }
}
