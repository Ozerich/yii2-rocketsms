<?php

namespace blakit\rocketsms\responses;

use blakit\rocketsms\structures\Sender;

class SendersResponse
{
    /** @var Sender[] */
    private $senders;

    /**
     * SendersResponse constructor.
     * @param array $response
     */
    public function __construct($response)
    {
        $this->senders = [];

        foreach ($response as $sender) {
            $item = new Sender();

            $item->sender = $sender['sender'];
            $item->verified = $sender['verified'];
            $item->checked = $sender['checked'];
            $item->registered = $sender['registered'];

            $this->senders[] = $item;
        }
    }

    /**
     * @return Sender[]
     */
    public function getSenders()
    {
        return $this->senders;
    }
}