<?php

namespace Omnipay\Cocard\Message;

use LSS\XML2Array;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Cocard Card Response
 */
class CardResponse extends Response implements RedirectResponseInterface
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return $this->data ? true : false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getTransactionReference()
    {
        return '';
    }


    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return '';
        }
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $redirectData = array(
            'PaReq' => '',
            'TermUrl' => '',
            'MD' => ''
        );
    }
}
