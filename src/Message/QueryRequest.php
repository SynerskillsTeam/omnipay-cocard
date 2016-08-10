<?php
/**
 * Cocard Query Request
 */

namespace Omnipay\Cocard\Message;

use LSS\XML2Array;

class QueryRequest extends AbstractRequest
{
    protected $endpoint = 'https://secure.cocardgateway.com/api/query.php';

    public function setParams($value)
    {
        return $this->setParameter('params', $value);
    }

    public function getParams()
    {
        return $this->getParameter('params');
    }

    public function getData()
    {
        return $this->getParams();
    }

    public function sendData($data, $root = 'query')
    {
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $this->getData())->send();
        $array = XML2Array::createArray($httpResponse->getBody(true));

        if (isset($array['nm_response'])) {
            $array['response'] = $array['nm_response'];
            unset($array['nm_response']);
            return $this->response = new Response($this, $array);
        } else {
            return $this->response = new Response($this, ['response' => []]);
        }
    }
}
