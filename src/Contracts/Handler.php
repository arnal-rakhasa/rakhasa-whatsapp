<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Handler
{
    /**
     * Handler construct
     */
    public function __construct();

    /**
     * Listen event handler
     *
     * @param string $type
     * @param array $data
     * @return void
     */
    public function listen(string $type, array $data);
}
