<?php

namespace Rakhasa\Whatsapp\Endpoints;

use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Endpoint AS EndpointContract;
use Rakhasa\Whatsapp\Contracts\Source;

class Endpoint
{
    /**
     * Endpoint instance
     *
     * @var EndpointContract
     */
    protected EndpointContract $endpoint;

    /**
     * Endpoint construct
     *
     * @param Adapter $adapter
     * @param Source $source
     */
    public function __construct(Adapter $adapter, Source $source)
    {
        $this->endpoint = $this->getSourceEndpoint($adapter, $source);
    }

    /**
     * Get endpoint according to source instance
     *
     * @param Adapter $adapter
     * @param Source $source
     * @return EndpointContract
     */
    private function getSourceEndpoint(Adapter $adapter, Source $source): EndpointContract
    {
        $endpoint = get_class($this);
        $base = class_basename($endpoint);

        $exploded = explode('\\', $endpoint);
        $exploded[3] = $source->getNamespace();

        array_push($exploded, $base);

        $imploded = implode('\\', $exploded);

        return new $imploded($adapter);
    }
}
