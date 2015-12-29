<?php
/**
 * CocardGateway Abstract Request
 *
 * @author Henter <henter@henter.me>
 * @date   2015-12-17
 */
 
namespace Omnipay\Cocard\Message;

use LSS\Array2XML;

/**
 * CocardGateway Abstract Request
 *
 * This class forms the base class for CocardGateway requests
 *
 * @link https://secure.cocardgateway.com/merchants/resources/integration/integration_portal.php
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://secure.cocardgateway.com/api/v2/three-step';


    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint($value)
    {
        $this->endpoint = $value;
        return $this;
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    protected function getCostInteger($amount)
    {
        return (int) round($amount * pow(10, $this->getCurrencyDecimalPlaces()));
    }

    /**
     * Send the request
     *
     * @return Response
     */
    public function send()
    {
        return $this->sendData($this->getData());
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public function sendData($data, $root = '')
    {
        if (!$root) {
            throw new \Exception('xml root empty');
        }
        $xmlDom = Array2XML::createXML($root, $this->getData());
        $headers = array(
            'Content-Type' => 'text/xml; charset=utf-8',
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $xmlDom->saveXML())->send();

        return $this->response = new Response($this, $httpResponse->getBody(true));
    }
}
