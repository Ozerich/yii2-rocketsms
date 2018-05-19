<?php

namespace blakit\rocketsms\responses;

class BalanceResponse
{
    /** @var int */
    private $credits;

    /** @var int */
    private $balance;

    /**
     * BalanceResponse constructor.
     * @param array $response
     */
    public function __construct($response)
    {
        $this->credits = $response['credits'];
        $this->balance = $response['balance'];
    }

    /**
     * @return int
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }
}