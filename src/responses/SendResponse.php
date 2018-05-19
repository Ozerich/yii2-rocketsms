<?php

namespace blakit\rocketsms\responses;

use blakit\rocketsms\constants\MessageStatus;

class SendResponse
{
    /** @var integer */
    private $message_id;

    /** @var MessageStatus */
    private $status;

    /** @var float */
    private $cost;

    /** @var integer */
    private $count;

    /**
     * SendResponse constructor.
     * @param array $response
     */
    public function __construct($response)
    {
        $this->message_id = $response['id'];
        $this->status = new MessageStatus($response['status']);
        $this->count = $response['cost']['credits'];
        $this->cost = $response['cost']['money'] * $this->count;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * @return MessageStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getTotalCost()
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return float
     */
    public function getMessageCost()
    {
        return $this->getTotalCost() / $this->getCount();
    }
}