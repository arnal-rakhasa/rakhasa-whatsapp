<?php

namespace Rakhasa\Whatsapp\Concerns;

trait HasInstance
{
    /**
     * Get QR Code in base64 format
     *
     * @return string
     */
    public function qrcode(): string
    {
        $this->checkClasses();

        return $this->instance->qrcode($this->key, $this->getWebhook(), $this->proxyUrl);
    }

    /**
     * Logout whatsapp session
     *
     * @return boolean
     */
    public function logout(): bool
    {
        $this->checkClasses();

        return $this->instance->logout($this->key);
    }

    /**
     * Get list contact
     *
     * @return array
     */
    public function contacts(): array
    {
        return $this->instance->info($this->key);
    }
}
