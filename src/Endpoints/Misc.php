<?php

namespace Rakhasa\Whatsapp\Endpoints;

use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Endpoint;

class Misc implements Endpoint
{
    /**
     * Endpoint instance class
     *
     * @var Endpoint
     */
    protected Endpoint $endpoint;

    /**
     * Misc construct
     *
     * @param Adapter $client
     */
    public function __construct(Adapter $client)
    {
        $this->endpoint = new \Rakhasa\Whatsapp\Endpoints\WaMulti\Misc($client);
    }

    /**
     * Undocumented function
     *
     * @param string $number
     * @param string $sessionId
     */
    public function hasWhatsapp(string $number, string $sessionId)
    {
        return $this->endpoint->hasWhatsapp($number, $sessionId);
    }
}
