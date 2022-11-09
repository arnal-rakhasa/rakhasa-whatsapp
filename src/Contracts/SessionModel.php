<?php

namespace Rakhasa\Whatsapp\Contracts;

interface SessionModel
{
    /**
     * Check is session connected
     *
     * @return boolean
     */
    public function isConnected(): bool;
}
