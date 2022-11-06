<?php

namespace Rakhasa\Whatsapp\Auth;

use Rakhasa\Whatsapp\Contracts\Auth;

class None implements Auth
{
    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return [];
    }
}
