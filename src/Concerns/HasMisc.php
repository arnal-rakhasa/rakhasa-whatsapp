<?php

namespace Rakhasa\Whatsapp\Concerns;

trait HasMisc
{
    /**
     * check if number registered on whatsapp
     *
     * @param string $number
     * @return boolean
     */
    public function hasWhatsapp(string $number): bool
    {
        $this->checkClasses();

        return $this->misc->hasWhatsapp($number, $this->key);
    }
}
