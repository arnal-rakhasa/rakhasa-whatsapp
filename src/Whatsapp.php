<?php

namespace Rakhasa\Whatsapp;

use Exception;
use Rakhasa\Whatsapp\Contracts\Auth;
use Rakhasa\Whatsapp\Endpoints\Misc;
use Rakhasa\Whatsapp\Adapters\Client;
use Rakhasa\Whatsapp\Concerns\HasAuth;
use Rakhasa\Whatsapp\Concerns\HasMisc;
use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Concerns\HasSource;
use Rakhasa\Whatsapp\Endpoints\Instance;
use Rakhasa\Whatsapp\Concerns\HasSession;
use Rakhasa\Whatsapp\Contracts\HostModel;
use Rakhasa\Whatsapp\Concerns\HasInstance;
use Rakhasa\Whatsapp\Contracts\ProxyModel;
use Rakhasa\Whatsapp\Contracts\SessionModel;

class Whatsapp
{
    use HasAuth, HasSession, HasInstance, HasMisc, HasSource;

    /**
     * auth class instance
     *
     * @var Auth
     */
    protected Auth $auth;

    /**
     * Instance class instance
     *
     * @var Instance
     */
    protected Instance $instance;

    /**
     * Instance class misc
     *
     * @var Misc
     */
    protected Misc $misc;

    /**
     * Instance of client adapter
     *
     * @var Client
     */
    protected Adapter $adapter;

    /**
     * Key session ID whatsapp
     *
     * @var string
     */
    protected string $key;

    /**
     * Session model
     *
     * @var SessionModel
     */
    protected SessionModel $session;

    /**
     * Host model
     *
     * @var HostModel|null
     */
    protected ?HostModel $host;

    /**
     * Proxy model
     *
     * @var ProxyModel|null
     */
    protected ?ProxyModel $proxy;

    /**
     * Proxy url
     *
     * @var string
     */
    protected string $proxyUrl;

    /**
     * Whatsapp construct
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;

        if ($this->getSession()) {
            $this->loadSession();
        }
    }

    /**
     * init whatsapp instance
     *
     * @return void
     */
    public function init()
    {
        $auth = $this->getAuthByNamespace($this->host->auth);
        $this->setAuth(new $auth);

        $this->initClasses();
    }

    /**
     * Initialized classes
     *
     * @return void
     */
    public function initClasses()
    {
        $source = $this->getSourceInstance();

        $this->adapter = new Client($this->auth, $this->host->host);
        $this->instance = new Instance($this->adapter, $source);
        $this->misc = new Misc($this->adapter, $source);
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
        return config('rakhasa-whatsapp.webhook')[$this->getSourceNamespace()]['base'];
    }

    /**
     * Persist session init
     *
     * @param array $data
     * @param string $lastEvent
     * @return boolean
     */
    public function persist(array $data, string $lastEvent): bool
    {
        if ($whatsappSession = $this->getSession()) {
            $whatsappSession->safeUpdate($data, $lastEvent);
            return true;
        }

        if (!$initSession = $this->getInitSession()) {
            return false;
        }

        $initSession->safeUpdate($data, $lastEvent);

        return true;
    }

    /**
     * Check if can call endpoint class
     *
     * @throws Exception
     * @return void
     */
    protected function checkClasses(): void
    {
        if (!isset($this->instance) || !isset($this->misc)) {
            throw new Exception('Session not initialized');
        }
    }
}
