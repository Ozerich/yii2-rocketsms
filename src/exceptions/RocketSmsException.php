<?php

namespace blakit\rocketsms\exceptions;

use blakit\rocketsms\constants\SmsError;

class RocketSmsException extends \Exception
{
    /** @var SmsError */
    private $error;

    public function __construct($error)
    {
        $this->error = new SmsError($error);

        parent::__construct((string)$this->error);
    }

    /**
     * @return SmsError
     */
    public function getError()
    {
        return $this->error;
    }
}