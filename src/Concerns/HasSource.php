<?php

namespace Rakhasa\Whatsapp\Concerns;

use Rakhasa\Whatsapp\Contracts\Source;

trait HasSource
{
    /**
     * Get source instance
     *
     * @return string
     */
    private function getSourceInstance(): Source
    {
        $class = $this->getSourceNamespace();
        return new $class;
    }

    /**
     * Get source namespace
     *
     * @return string
     */
    private function getSourceNamespace(): string
    {
        return $this->host->source;
    }
}
