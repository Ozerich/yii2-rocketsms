<?php

namespace blakit\rocketsms\responses;

use blakit\rocketsms\constants\MessageStatus;

class StatusResponse
{
    /** @var integer */
    private $message_id;

    /** @var MessageStatus */
    private $status;

    /**
     * StatusResponse constructor.
     * @param array $response
     */
    public function __construct($response)
    {
        $this->message_id = $response['id'];
        $this->status = new MessageStatus($response['status']);
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
}