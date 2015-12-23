<?php

namespace Omnipay\Cocard\Message;

use LSS\XML2Array;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\RequestInterface;

/**
 * Cocard Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $array = XML2Array::createArray($data);

        if (!isset($array['response'])) {
            throw new InvalidResponseException;
        }
        $this->data = $array['response'];
        unset($array);
    }

}
