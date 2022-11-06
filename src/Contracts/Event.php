<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Event
{
    /**
     * Event construct
     *
     * @param string $source
     * @param string $type
     * @param array $data
     */
    public function __construct(string $source, string $type, array $data);
}
