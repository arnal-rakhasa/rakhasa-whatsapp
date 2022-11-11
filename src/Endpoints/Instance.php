<?php

namespace Rakhasa\Whatsapp\Endpoints;

use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Source;
use Rakhasa\Whatsapp\Endpoints\Endpoint;

class Instance extends Endpoint
{
    /**
     * source class instance
     *
     * @var Source
     */
    protected Source $source;

    /**
     * Instance construct
     *
     * @param Adapter $client
     */
    public function __construct(Adapter $client, Source $source)
    {
        parent::__construct($client, $source);
    }

    /**
     * get qrcode
     *
     * @param string $key
     * @param string $webhook
     * @param string $proxyUrl|null
     * @return string
     */
    public function qrcode(string $key, string $webhook, ?string $proxyUrl): string
    {
        return $this->endpoint->qrcode($key, $webhook, $proxyUrl);
    }

    /**
     * Get list contact
     *
     * @param string $key
     * @return array
     */
    public function contacts(string $key): array
    {
        return $this->endpoint->contacts($key);
    }

    /**
     * logout whatsapp session
     *
     * @param string $key
     * @return boolean
     */
    public function logout(string $key): bool
    {
        return $this->endpoint->logout($key);
    }
}
