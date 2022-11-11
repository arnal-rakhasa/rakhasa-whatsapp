<?php

namespace Rakhasa\Whatsapp\Auth;

use Rakhasa\Whatsapp\Contracts\Auth;

class APIKey implements Auth
{
    /**
     * API token
     *
     * @var string|null
     */
    private ?string $apiToken;

    /**
     * construct
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->apiToken = $properties['token'];
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/keyauth.api.v1+json',
            'X-Token' => $this->apiToken
        ];
    }
}
