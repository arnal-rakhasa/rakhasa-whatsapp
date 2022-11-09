<?php

namespace Rakhasa\Whatsapp\Concerns;

use Rakhasa\Whatsapp\Contracts\Auth;
use Rakhasa\Whatsapp\Exceptions\AuthNotFoundException;

trait HasAuth
{
    /**
     * Set AUTH class
     *
     * @param Auth $auth
     * @return void
     */
    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * Get AUTH class
     *
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth;
    }

    /**
     * Get list of auth
     *
     * @return array
     */
    public function auth(): array
    {
        return config('rakhasa-whatsapp.auth.list');
    }

    /**
     * Get auth by name
     *
     * @throws AuthNotFoundException
     * @param string $name
     * @return string
     */
    public function getAuthByName(string $name): string
    {
        if (!array_key_exists($name, $this->auth())) {
            throw new AuthNotFoundException('name', $name);
        }

        return $this->auth()[$name];
    }

    /**
     * Get auth by namespace
     *
     * @throws AuthNotFoundException
     * @param string $namespace
     * @return string
     */
    public function getAuthByNamespace(string $namespace): string
    {
        if (!in_array($namespace, $this->auth())) {
            throw new AuthNotFoundException('class', $namespace);
        }

        return $namespace;
    }
}
