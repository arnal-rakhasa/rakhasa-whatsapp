<?php

namespace Rakhasa\Whatsapp\Exceptions;

use Exception;

class WhatsappNotLoggedIn extends Exception
{
    /**
     * Exception construct
     */
    public function __construct()
    {
        parent::__construct("Whatsapp not logged in");
    }
}
