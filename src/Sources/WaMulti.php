<?php

namespace Rakhasa\Whatsapp\Sources;

use Rakhasa\Whatsapp\Contracts\Source;

class WaMulti implements Source
{
    /**
     * @inheritDoc
     */
    public function getNamespace(): string
    {
        return 'WaMulti';
    }
}
