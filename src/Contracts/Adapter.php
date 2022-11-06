<?php

namespace Rakhasa\Whatsapp\Contracts;

use Illuminate\Http\Client\Response;
use Rakhasa\Whatsapp\Contracts\Auth;

interface Adapter
{
    /**
     * Adapter constructor.
     *
     * @param Auth $auth
     * @param string $baseURI
     */
    public function __construct(Auth $auth, string $baseURI);

    /**
     * Enable option to send as form
     *
     * @return self
     */
    public function asForm(): self;

    /**
     * Sends a GET request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    public function get(string $uri, array $data = []): Response;

    /**
     * Sends a POST request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    public function post(string $uri, array $data = []): Response;

    /**
     * Sends a PUT request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    public function put(string $uri, array $data = []): Response;

    /**
     * Sends a PATCH request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    public function patch(string $uri, array $data = []): Response;

    /**
     * Sends a DELETE request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    public function delete(string $uri, array $data = []): Response;
}
