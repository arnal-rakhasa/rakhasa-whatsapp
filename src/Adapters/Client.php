<?php

namespace Rakhasa\Whatsapp\Adapters;

use Illuminate\Support\Facades\Http;
use Rakhasa\Whatsapp\Contracts\Adapter;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Rakhasa\Whatsapp\Contracts\Auth;

class Client implements Adapter
{
    /**
     * Http client
     *
     * @var PendingRequest
     */
    protected PendingRequest $client;

    /**
     * @inheritDoc
     */
    public function __construct(Auth $auth, string $baseUrl)
    {
        $this->client = Http::baseUrl($baseUrl)
            ->acceptJson();

        if (count($auth->getHeaders())) {
            $this->client->withHeaders($auth->getHeaders());
        }
    }

    /**
     * @inheritDoc
     */
    public function asForm(): self
    {
        $this->client->asForm();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get(string $url, array $query = []): Response
    {
        return $this->client->get($url, $query);
    }

    /**
     * @inheritDoc
     */
    public function post(string $url, array $data = []): Response
    {
        return $this->client->post($url, $data);
    }

    /**
     * @inheritDoc
     */
    public function put(string $url, array $data = []): Response
    {
        return $this->client->put($url, $data);
    }

    /**
     * @inheritDoc
     */
    public function patch(string $url, array $data = []): Response
    {
        return $this->client->patch($url, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $url, array $data = []): Response
    {
        return $this->client->delete($url, $data);
    }
}
