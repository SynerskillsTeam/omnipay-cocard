<?php

namespace Omnipay\Cocard\Message;

class CompleteRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('token');
        return [
            'api-key' => $this->getApiKey(),
            'token-id' => $this->getToken()
        ];
    }

    public function sendData($data, $root = '')
    {
        return parent::sendData($data, 'complete-action');
    }
}
