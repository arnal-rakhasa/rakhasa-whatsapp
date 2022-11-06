<?php

namespace Rakhasa\Whatsapp\Sources;

use Rakhasa\Whatsapp\Contracts\Source;

class Wabot implements Source
{
    /**
     * @inheritDoc
     */
    public function getNamespace(): string
    {
        return 'Wabot';
    }
}
