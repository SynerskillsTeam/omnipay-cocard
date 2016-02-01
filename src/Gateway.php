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
     * customer credit card authorize to a transaction
     *
     * @param  array $parameters
     * @return \Omnipay\Cocard\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\AuthorizeRequest', $parameters);
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
     * "sale" on cocardgateway
     *
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
     * to void transaction
     *
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\VoidRequest
     */
    public function void(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\VoidRequest', $parameters);
    }

    /**
     * to update transaction
     *
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\UpdateRequest
     */
    public function update(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\UpdateRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\AddPlanRequest
     */
    public function addPlan(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\AddPlanRequest', $parameters);
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
        return $this->createRequest('\Omnipay\Cocard\Message\UpdateRecurringRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\DeleteRecurringRequest
     */
    public function deleteRecurring(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\DeleteRecurringRequest', $parameters);
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

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\AddBillingRequest
     */
    public function addBilling(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\AddBillingRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\UpdateBillingRequest
     */
    public function updateBilling(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\UpdateBillingRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Cocard\Message\DeleteBillingRequest
     */
    public function deleteBilling(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cocard\Message\DeleteBillingRequest', $parameters);
    }
}
