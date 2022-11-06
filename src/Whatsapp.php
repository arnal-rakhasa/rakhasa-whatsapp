<?php

namespace Rakhasa\Whatsapp;

use Exception;
use Illuminate\Support\Str;
use Rakhasa\Whatsapp\Auth\None;
use Rakhasa\Whatsapp\Contracts\Auth;
use Rakhasa\Whatsapp\Adapters\Client;
use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Source;
use Rakhasa\Whatsapp\Endpoints\Instance;
use Rakhasa\Whatsapp\Endpoints\Misc;

class Whatsapp
{
    /**
     * auth class instance
     *
     * @var Auth
     */
    protected Auth $auth;

    /**
     * instance class instance
     *
     * @var Instance
     */
    protected Instance $instance;

    /**
     * instance class misc
     *
     * @var Misc
     */
    protected Misc $misc;

    /**
     * instance of client adapter
     *
     * @var Client
     */
    protected Adapter $adapter;

    /**
     * key for session id
     *
     * @var string
     */
    protected string $key = '';

    /**
     * webhook of whatsapp
     *
     * @var string
     */
    protected string $webhook;

    /**
     * proxy url
     *
     * @var string
     */
    protected string $proxyUrl;

    /**
     * Whatsapp construct
     *
     * @param string $baseUrl
     * @param Auth|null $auth
     * @param Source|null $source
     */
    public function __construct(string $baseUrl, ?Auth $auth = null, ?Source $source = null)
    {
        if (is_null($auth)) {
            $auth = new None;
        }
        if (is_null($source)) {
            $class = config('rakhasa-whatsapp.source.default');
            $source = new $class;
        }
        $this->adapter = new Client($auth, $baseUrl);
        $this->instance = new Instance($this->adapter, $source);
        $this->misc = new Misc($this->adapter, $source);
    }

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
     * init whatsapp instance
     *
     * @param string $key
     * @param string $webhook
     * @param string $proxyUrl
     * @return void
     */
    public function init(string $key, string $webhook = '', string $proxyUrl = '')
    {
        $this->key = $key;
        $this->webhook = $webhook;
        $this->proxyUrl = $proxyUrl;
    }

    /**
     * get key session ID
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * get webhook of whatsapp
     *
     * @return string
     */
    public function getWebhook(): string
    {
        return $this->webhook;
    }

    /**
     * get qrcode in base64 format
     *
     * @return string
     */
    public function qrcode(): string
    {
        $this->checkKey();

        return $this->instance->qrcode($this->key, $this->webhook, $this->proxyUrl);
    }

    /**
     * check if number registered on whatsapp
     *
     * @param string $number
     * @return boolean
     */
    public function hasWhatsapp(string $number): bool
    {
        return $this->misc->hasWhatsapp($number, $this->key);
    }

    /**
     * Undocumented function
     *
     * @throws Exception
     * @return void
     */
    private function checkKey(): void
    {
        if (!$this->key) {
            throw new Exception('key not initialized');
        }
    }
}
