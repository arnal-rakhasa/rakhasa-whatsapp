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
     * @param string $proxyUrl
     * @return string
     */
    public function qrcode(string $key, string $webhook, string $proxyUrl): string
    {
        return $this->endpoint->qrcode($key, $webhook, $proxyUrl);
    }

    /**
     * logout whatsapp session
     *
     * @return boolean
     */
    public function logout(): bool
    {
        return $this->endpoint->logout($key);
    }
}
