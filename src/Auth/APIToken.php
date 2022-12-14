<?php

namespace Rakhasa\Whatsapp\Auth;

use Rakhasa\Whatsapp\Contracts\Auth;

class APIToken implements Auth
{
    /**
     * Bearer api token
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
            'Authorization' => 'Bearer ' . $this->apiToken
        ];
    }
}
