<?php

namespace Rakhasa\Whatsapp\Contracts;

interface Source
{
    /**
     * get namespace of source
     *
     * @return string
     */
    public function getNamespace(): string;
}
