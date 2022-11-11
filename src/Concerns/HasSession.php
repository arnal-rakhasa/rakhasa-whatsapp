<?php

namespace Rakhasa\Whatsapp\Concerns;

use Exception;
use Rakhasa\Whatsapp\Endpoints\Misc;
use Illuminate\Support\Facades\Cache;
use Rakhasa\Whatsapp\Adapters\Client;
use Rakhasa\Whatsapp\Endpoints\Instance;
use Rakhasa\Whatsapp\Contracts\HostModel;
use Rakhasa\Whatsapp\Contracts\ProxyModel;
use Rakhasa\Whatsapp\Contracts\SessionModel;

trait HasSession
{
    /**
     * Create new session
     *
     * @param HostModel $host
     * @param ProxyModel|null $proxy
     * @return void
     */
    public function createSession(HostModel $host, ?ProxyModel $proxy)
    {
        $this->host = $host;
        $this->proxyUrl = $proxy ? $proxy->getProxyUrl() : '';

        if ($this->getSession()) {
            throw new Exception('Whatsapp session already exists');
        }

        $this->init();

        $this->createInitSession();

        return $this->qrcode();
    }

    /**
     * Get session model
     *
     * @return SessionModel|null
     */
    private function getSession(): ?SessionModel
    {
        return $this->getSessionModelNamespace()::where('session_id', $this->key)->first();
    }

    /**
     * Get session model namespace
     *
     * @return string
     */
    public function getSessionModelNamespace(): string
    {
        return config('rakhasa-whatsapp.models.session');
    }

    public function loadSession()
    {
        $this->session = $this->getSession();

        $this->host = $this->session->whatsappHost;

        $auth = $this->getAuthByNamespace($this->host->auth);
        $this->setAuth(new $auth($this->session->whatsappHost->auth_properties));

        $this->initClasses();
    }

    /**
     * Create session
     *
     * @return void
     */
    private function createInitSession(): void
    {
        $class = $this->getSessionModelNamespace();
        $value = new $class([
            'session_id' => $this->key,
            'whatsapp_host_id' => $this->host->id,
            'proxy_url' => $this->proxyUrl
        ]);
        Cache::put('whatsapp-session-' . $this->key, $value, 30);
    }

    /**
     * Get initial session from cache
     *
     * @return SessionModel|null
     */
    private function getInitSession(): ?SessionModel
    {
        return Cache::get('whatsapp-session-' . $this->key);
    }
}
