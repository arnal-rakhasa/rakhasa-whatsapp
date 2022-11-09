<?php

namespace Rakhasa\Whatsapp\Exceptions;

use Exception;

class InvalidSessionIdException extends Exception
{
    /**
     * Exception construct
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        parent::__construct("Invalid session id $sessionId");
    }
}
