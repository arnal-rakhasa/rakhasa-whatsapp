<?php

namespace Rakhasa\Whatsapp\Endpoints\Wabot;

use Rakhasa\Whatsapp\Exceptions\ApiResponseException;
use Rakhasa\Whatsapp\Concerns\HasRequest;
use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Endpoint;

class Misc implements Endpoint
{
    use HasRequest;

    /**
     * adapter class instance
     *
     * @var Adapter
     */
    protected Adapter $adapter;

    /**
     * instance construct
     *
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * check if number registered on whatsapp
     *
     * @throws ApiResponseException
     * @param string $number
     * @param string $sessionId
     * @return boolean
     */
    public function hasWhatsapp(string $number, string $sessionId): bool
    {
        $response = $this->adapter->get('misc/onwhatsapp', $this->validateRequest([
            'key' => $sessionId,
            'id' => $number
        ]));

        if ($response->failed()) {
            throw new ApiResponseException($response->json('message'));
        }

        return $response->json('data');
    }
}
