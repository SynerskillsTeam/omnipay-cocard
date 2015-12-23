<?php
/**
 * CocardGateway Abstract Request
 *
 * @author Henter <henter@henter.me>
 * @date 2015-12-17
 */
 
namespace Omnipay\Cocard\Message;

/**
 * CocardGateway Abstract Request
 *
 * This class forms the base class for CocardGateway requests
 *
 * @link https://secure.cocardgateway.com/merchants/resources/integration/integration_portal.php?tid=283bdefb897fc675bc888f5e41032c03#3step_methodology
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://secure.cocardgateway.com/api/v2/three-step';


    public function getEndpoint(){
        return $this->endpoint;
    }

    public function setEndpoint($value){
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


}
