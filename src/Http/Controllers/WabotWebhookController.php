<?php

namespace Rakhasa\Whatsapp\Http\Controllers;

use Illuminate\Http\Request;
use Rakhasa\Whatsapp\Events\MessageAudioEvent;
use Rakhasa\Whatsapp\Events\MessageContactEvent;
use Rakhasa\Whatsapp\Events\MessageDocEvent;
use Rakhasa\Whatsapp\Events\MessageImageEvent;
use Rakhasa\Whatsapp\Events\MessageLocationEvent;
use Rakhasa\Whatsapp\Sources\Wabot;
use Rakhasa\Whatsapp\Events\NotifyLogoutEvent;
use Rakhasa\Whatsapp\Events\NotifyReceiveEvent;
use Rakhasa\Whatsapp\Events\NotifyConnectivityEvent;
use Rakhasa\Whatsapp\Events\MessageTextEvent;
use Rakhasa\Whatsapp\Events\MessageVideoEvent;

class WabotWebhookController extends Controller
{
    /**
     * handler event notify logout
     *
     * @param Request $request
     * @return void
     */
    public function notifyLogout(Request $request)
    {
        event(new NotifyLogoutEvent(Wabot::class, 'notify.logout', $request->all()));
    }

    /**
     * handler event notify receive
     *
     * @param Request $request
     * @return void
     */
    public function notifyReceive(Request $request)
    {
        event(new NotifyReceiveEvent(Wabot::class, 'notify.receive', $request->all()));
    }

    /**
     * handler event notify connectivity
     *
     * @param Request $request
     * @return void
     */
    public function notifyConnectivity(Request $request)
    {
        event(new NotifyConnectivityEvent(Wabot::class, 'notify.connectivity', $request->all()));
    }
}
