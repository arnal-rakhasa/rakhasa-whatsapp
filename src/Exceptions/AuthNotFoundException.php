<?php

namespace Rakhasa\Whatsapp\Exceptions;

use Exception;

class AuthNotFoundException extends Exception
{
    /**
     * Exception construct
     *
     * @param string $attribute
     * @param string $value
     */
    public function __construct(string $attribute, string $value)
    {
        parent::__construct("Unable to find auth with $attribute $value");
    }
}
