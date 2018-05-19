<?php

namespace blakit\rocketsms;

use blakit\rocketsms\exceptions\ErrorResponseException;
use blakit\rocketsms\exceptions\InvalidCredentialsException;
use blakit\rocketsms\responses\BalanceResponse;
use blakit\rocketsms\responses\SendersResponse;
use blakit\rocketsms\responses\SendResponse;
use blakit\rocketsms\responses\StatusResponse;
use blakit\rocketsms\responses\TemplatesResponse;
use yii\base\Component;
use yii\base\InvalidConfigException;

class RocketSms extends Component
{
    /** @var string */
    public $login;

    /** @var string */
    public $password;

    public function init()
    {
        parent::init();

        if (!$this->login) {
            throw new InvalidConfigException('RocketSMS login is not set');
        }

        if (!$this->password) {
            throw new InvalidConfigException('RocketSMS password is not set');
        }
    }

    /**
     * @param $message
     */
    private function log($message)
    {
        \Yii::info($message, 'rocket_sms');
    }

    /**
     * @param string $url
     * @param array $post_body
     * @return mixed
     * @throws ErrorResponseException
     * @throws InvalidCredentialsException
     */
    private function httpRequest($url, $post_body = [])
    {
        $body = http_build_query($post_body);

        $this->log('Request: ' . $url . ' ' . $body);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

        $response = curl_exec($curl);
        $this->log('Response: ' . $response);
        $result = @json_decode($response, true);

        curl_close($curl);

        if (isset($result['error'])) {
            if ($result['error'] == 'WRONG_AUTH') {
                throw new InvalidCredentialsException($result['error']);
            }

            throw new ErrorResponseException($result['error']);
        }

        return $result;
    }

    /**
     * @param string $method
     * @param array $body
     * @return mixed
     */
    private function request($method, $body = [])
    {
        $post = array_merge([
            'username' => $this->login,
            'password' => $this->password
        ], $body);

        return $this->httpRequest('http://api.rocketsms.by/simple/' . $method, $post);
    }

    /**
     * @param string $phone
     * @return string
     */
    private function preparePhone($phone)
    {
        if (mb_strlen($phone) == 9) {
            $phone = '375' . $phone;
        } else if (mb_substr($phone, 0, 2) == '80') {
            $phone = '375' . mb_substr($phone, 2);
        }

        $phone = preg_replace('/[^0-9,.]/', '', $phone);

        return $phone;
    }

    /**
     * @param string $phone
     * @param string $text
     * @param string $sender
     * @param int|null $timestamp
     * @param bool|null $priority
     * @return SendResponse
     */
    public function send($phone, $text, $sender = '', $timestamp = null, $priority = null)
    {
        $query = [
            'phone' => $this->preparePhone($phone),
            'text' => $text,
        ];

        if (!empty($sender)) {
            $query['sender'] = $sender;
        }

        if ($timestamp) {
            $query['timestamp'] = $timestamp;
        }

        if ($priority !== null) {
            $query['priority'] = $priority;
        }

        $response = $this->request('send', $query);

        return new SendResponse($response);
    }

    /**
     * @param int $message_id
     * @return StatusResponse
     */
    public function status($message_id)
    {
        $response = $this->request('status', [
            'id' => $message_id
        ]);

        return new StatusResponse($response);
    }

    /**
     * @return BalanceResponse
     */
    public function balance()
    {
        $response = $this->request('balance');

        return new BalanceResponse($response);
    }

    /**
     * @return SendersResponse
     */
    public function senders()
    {
        $response = $this->request('senders');

        return new SendersResponse($response);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function addSender($name)
    {
        $this->request('senders/add', [
            'sender' => $name
        ]);

        return true;
    }

    /**
     * @return TemplatesResponse
     */
    public function templates()
    {
        $response = $this->request('templates');

        return new TemplatesResponse($response);
    }
}