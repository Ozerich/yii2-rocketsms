<?php

namespace blakit\rocketsms\constants;

use MyCLabs\Enum\Enum;

class MessageStatus extends Enum
{
    const QUEUED = 'QUEUED';
    const SENT = 'SENT';
    const DELIVERED = 'DELIVERED';
    const FAILED = 'FAILED';
}