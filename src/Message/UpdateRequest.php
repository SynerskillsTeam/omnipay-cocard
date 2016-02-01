<?php
/**
 * Cocard Update Request
 */

namespace Omnipay\Cocard\Message;

class UpdateRequest extends AbstractRequest
{

    public function getTrackingNumber()
    {
        return $this->getParameter('tracking-number');
    }

    public function setTrackingNumber($value)
    {
        return $this->setParameter('tracking-number', $value);
    }

    public function getShippingCarrier()
    {
        return $this->getParameter('shipping-carrier');
    }

    public function setShippingCarrier($value)
    {
        return $this->setParameter('shipping-carrier', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('order-id');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('order-id', $value);
    }

    public function getData()
    {
        $this->validate('transactionId');

        return [
            'api-key' => $this->getApiKey(),
            'transaction-id' => $this->getTransactionId(),
            'merchant-defined-field-1' => 'test',
            'tracking-number' => $this->getTrackingNumber(),
            'shipping-carrier' => $this->getShippingCarrier(),
            'order-id' => $this->getOrderId()
        ];
    }

    public function sendData($data, $root = 'void')
    {
        return parent::sendData($data, $root);
    }
}
