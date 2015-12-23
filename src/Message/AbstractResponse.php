<?php
namespace Omnipay\Cocard\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse implements RedirectResponseInterface
{
    public static $MESSAGES = array(
        '100' => 'Transaction was approved.',
        '200' => 'Transaction was declined by processor.',
        '201' => 'Do not honor.',
        '202' => 'Insufficient funds.',
        '203' => 'Over limit.',
        '204' => 'Transaction not allowed.',
        '220' => 'Incorrect payment information.',
        '221' => 'No such card issuer.',
        '222' => 'No card number on file with issuer.',
        '223' => 'Expired card.',
        '224' => 'Invalid expiration date.',
        '225' => 'Invalid card security code.',
        '240' => 'Call issuer for further information.',
        '250' => 'Pick up card.',
        '251' => 'Lost card.',
        '252' => 'Stolen card.',
        '253' => 'Fraudulent card.',
        '260' => 'Declined with further instructions available.\
            (See response text) 261 Declined-Stop all recurring payments.',
        '262' => 'Declined-Stop this recurring program.',
        '263' => 'Declined-Update cardholder data available.',
        '264' => 'Declined-Retry in a few days.',
        '300' => 'Transaction was rejected by gateway.',
        '400' => 'Transaction error returned by processor.',
        '410' => 'Invalid merchant configuration.',
        '411' => 'Merchant account is inactive.',
        '420' => 'Communication error.',
        '421' => 'Communication error with issuer.',
        '430' => 'Duplicate transaction at processor.',
        '440' => 'Processor format error.',
        '441' => 'Invalid transaction information.',
        '460' => 'Processor feature not available.',
        '461' => 'Unsupported card type.',
    );

    public function getResult()
    {
        return $this->data['result'];
    }

    public function isSuccessful()
    {
        return 1 === (int) $this->getResult();
    }

    public function getTransactionReference()
    {
        return isset($this->data['transaction-id']) ? (string) $this->data['transaction-id'] : null;
    }

    public function getMessage()
    {
        $codes = explode(',', $this->getCode());
        $messages = array();

        foreach ($codes as $code) {
            $code = trim($code);
            if (isset(static::$MESSAGES[$code])) {
                $messages[] = static::$MESSAGES[$code];
            } else {
                $messages[] = $code;
            }
        }

        return implode(', ', $messages) ?: null;
    }

    public function getCode()
    {
        return $this->data['result-code'];
    }

    public function getText()
    {
        return (string) $this->data['result-text'];
    }


    public function isRedirect()
    {
        return false;
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
