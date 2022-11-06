<?php

namespace Rakhasa\Whatsapp\Handlers;

use Rakhasa\Whatsapp\Contracts\Handler;

class WaMultiHandler implements Handler
{
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
        // if ($data)
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

    }
}
