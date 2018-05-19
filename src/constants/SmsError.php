<?php

namespace blakit\rocketsms\constants;

use MyCLabs\Enum\Enum;

class SmsError extends Enum
{
    const WRONG_AUTH = 'WRONG_AUTH';
    const NO_MESSAGE = 'NO_MESSAGE';
    const NO_PHONE = 'NO_PHONE';
    const BAD_PHONE = 'BAD_PHONE';
    const WRONG_ID = 'WRONG_ID';
    const SENDER_ALREADY_ADDED = 'SENDER_ALREADY_ADDED';
    const SENDER_TOO_LONG = 'SENDER_TOO_LONG';
    const SENDER_BAD_FORMAT = 'SENDER_BAD_FORMAT';

    /**
     * @return string
     */
    public function __toString()
    {
        switch ($this->value) {
            case self::WRONG_AUTH:
                return 'Invalid credentials';
            case self::NO_MESSAGE:
                return 'Message is empty';
            case self::NO_PHONE:
                return 'Phone is empty';
            case self::BAD_PHONE:
                return 'Invalid phone number';
            case self::WRONG_ID:
                return 'Invalid message ID';
            case self::SENDER_ALREADY_ADDED:
                return 'Sender has already added';
            case self::SENDER_TOO_LONG:
                return 'Sender too long';
            case self::SENDER_BAD_FORMAT:
                return 'Sender is invalid';
            default:
                return parent::__toString();
        }

    }
}