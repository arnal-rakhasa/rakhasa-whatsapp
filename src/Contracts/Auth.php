<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Auth
{
    /**
     * get header array
     *
     * @return array
     */
    public function getHeaders(): array;
}
