<?php

namespace Rakhasa\Whatsapp\Auth;

use Rakhasa\Whatsapp\Contracts\Auth;

class APIToken implements Auth
{
    /**
     * bearer api token
     *
     * @var string
     */
    private string $apiToken;

    /**
     * construct
     *
     * @param string $apiToken
     */
    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
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
