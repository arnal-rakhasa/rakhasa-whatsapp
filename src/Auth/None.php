<?php

namespace Rakhasa\Whatsapp\Auth;

use Rakhasa\Whatsapp\Contracts\Auth;

class None implements Auth
{
    /**
     * construct
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return [];
    }
}
