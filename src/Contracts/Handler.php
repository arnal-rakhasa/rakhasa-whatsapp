<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Handler
{
    /**
     * listen event handler
     *
     * @param string $type
     * @param array $data
     * @return void
     */
    public function listen(string $type, array $data);
}
