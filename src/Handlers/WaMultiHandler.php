<?php

namespace Rakhasa\Whatsapp\Handlers;

use Rakhasa\Whatsapp\Contracts\Handler;

class WaMultiHandler implements Handler
{
    /**
     * whatsapp host class basename
     *
     * @var string
     */
    protected string $whatsappHost;

    /**
     * whatsapp proxy class basename
     *
     * @var string
     */
    protected string $whatsappProxy;

    /**
     * whatsapp session class basename
     *
     * @var string
     */
    protected string $whatsappSession;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->whatsappHost = config('rakhasa-whatsapp.models.session');
        $this->whatsappProxy = config('rakhasa-whatsapp.models.session');
        $this->whatsappSession = config('rakhasa-whatsapp.models.session');
    }

    /**
     * @inheritDoc
     */
    public function listen(string $type, array $data)
    {
        switch ($type) {
            case 'notify.logout':
                $this->notifyLogout($data);
                break;
            case 'notify.receive':
                $this->notifyReceive($data);
                break;
            case 'notify.connectivity':
                $this->notifyConnectivity($data);
                break;
        }
    }

    /**
     * notify logout handler
     *
     * @param array $data
     * @return void
     */
    private function notifyLogout(array $data): void
    {
        if (isset($data['sessionId'])) {
            $sessionId = $data['sessionId'];

            $this->whatsappHost::where('session_id', $sessionId)->update([
                'is_connected' => 0,
                'last_event' => 'notify.logout',
                'last_message' => $data['reason']
            ]);
        }
    }

    /**
     * notify receive handler
     *
     * @param array $data
     * @return void
     */
    private function notifyReceive(array $data): void
    {

    }

    /**
     * notify connectivity handler
     *
     * @param array $data
     * @return void
     */
    private function notifyConnectivity(array $data): void
    {
        if (isset($data['sessionId'])) {
            $sessionId = $data['sessionId'];

            $this->whatsappHost::updateOrCreate([
                'session_id' => $sessionId
            ], [
                'is_connected' => $data['isConnected'],
                'name' => $data['pushName'],
                'number' => $data['number'],
                'last_event' => 'notify.connectivity',
                'last_message' => $data['reason']
            ]);
        }
    }
}
