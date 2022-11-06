<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Endpoint
{
    /**
     * Endpoint construct
     *
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter);
}
