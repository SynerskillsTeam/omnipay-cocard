<?php
/**
 * Cocard Purchase Request
 */

namespace Omnipay\Cocard\Message;


class PurchaseRequest extends AbstractRequest
{
    public function setBilling($value)
    {
        $this->setParameter('billing', $value);
    }

    public function getBilling()
    {
        return $this->getParameter('billing');
    }

    public function setShipping($value)
    {
        $this->setParameter('shipping', $value);
    }

    public function getShipping()
    {
        return $this->getParameter('shipping');
    }

    public function setBaseData($value)
    {
        $this->setParameter('baseData', $value);
    }

    public function getBaseData()
    {
        return $this->getParameter('baseData');
    }

    public function getProducts()
    {
        return $this->getParameter('products');
    }

    /**
     * set products, check product keys
     * @param $products
     * @return \Omnipay\Common\Message\AbstractRequest
     * @throws \Exception
     */
    public function setProducts($products)
    {
        $required_keys = [
            'product-code',
            'description',
            'commodity-code',
            'unit-of-measure',
            'unit-cost',
            'quantity',
            'total-amount',
            'tax-amount',
            'tax-rate'
        ];

        foreach ($products as $product) {
            foreach ($required_keys as $rk) {
                if (!isset($product[$rk])) {
                    throw new \Exception("product key error: ".$rk);
                }
            }
        }
        return $this->setParameter('products', $products);
    }

    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $array = [
            'api-key' => $this->getApiKey(),
            'redirect-url' => $this->getReturnUrl(),
            'amount' => $this->getAmount(),
            'ip-address' => $this->getClientIp(),
            'currency' => $this->getCurrency(),
            'billing' => $this->getBilling(),
            'shipping' => $this->getShipping(),
            'product' => $this->getProducts(),
            //'order-id' => '123',
            //'order-description' => 'xxx',
            //'merchant-defined-field-1' => 'test1',
            //'tax-amount' => 0.00,
            //'shipping-amount' => 0.00,
            //'customer-id' => 123456, //same with customer-vault-id
        ];

        //customer-vault-id, order-id, order-description, merchant-defined-field-x, tax-amount, shipping-amount
        if ($base = $this->getBaseData()) {
            $base_keys = ['customer-vault-id', 'order-id', 'order-description', 'tax-amount', 'shipping-amount'];
            foreach ($base_keys as $bk) {
                if (isset($base[$bk])) {
                    $array[$bk] = $base[$bk];
                }
            }
        }

        if (!$array['product']) {
            throw new \Exception("products error");
        }
        return $array;
    }

    public function sendData($data)
    {
        return parent::sendData($data, 'sale');
    }
}
