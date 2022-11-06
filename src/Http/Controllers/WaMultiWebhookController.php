<?php

namespace Rakhasa\Whatsapp\Http\Controllers;

use Illuminate\Http\Request;
use Rakhasa\Whatsapp\Events\MessageAudioEvent;
use Rakhasa\Whatsapp\Events\MessageContactEvent;
use Rakhasa\Whatsapp\Events\MessageDocEvent;
use Rakhasa\Whatsapp\Events\MessageImageEvent;
use Rakhasa\Whatsapp\Events\MessageLocationEvent;
use Rakhasa\Whatsapp\Sources\WaMulti;
use Rakhasa\Whatsapp\Events\NotifyLogoutEvent;
use Rakhasa\Whatsapp\Events\NotifyReceiveEvent;
use Rakhasa\Whatsapp\Events\NotifyConnectivityEvent;
use Rakhasa\Whatsapp\Events\MessageTextEvent;
use Rakhasa\Whatsapp\Events\MessageVideoEvent;

class WaMultiWebhookController extends Controller
{
    /**
     * handler event notify logout
     *
     * @param Request $request
     * @return void
     */
    public function notifyLogout(Request $request)
    {
        event(new NotifyLogoutEvent(WaMulti::class, 'notify.logout', $request->all()));
    }

    /**
     * handler event notify receive
     *
     * @param Request $request
     * @return void
     */
    public function notifyReceive(Request $request)
    {
        event(new NotifyReceiveEvent(WaMulti::class, 'notify.receive', $request->all()));
    }

    /**
     * handler event notify connectivity
     *
     * @param Request $request
     * @return void
     */
    public function notifyConnectivity(Request $request)
    {
        event(new NotifyConnectivityEvent(WaMulti::class, 'notify.connectivity', $request->all()));
    }

    /**
     * handler event message text
     *
     * @param Request $request
     * @return void
     */
    public function messageText(Request $request)
    {
        event(new MessageTextEvent(WaMulti::class, 'message.text', $request->all()));
    }

    /**
     * handler event message image
     *
     * @param Request $request
     * @return void
     */
    public function messageImage(Request $request)
    {
        event(new MessageImageEvent(WaMulti::class, 'message.image', $request->all()));
    }

    /**
     * handler event message video
     *
     * @param Request $request
     * @return void
     */
    public function messageVideo(Request $request)
    {
        event(new MessageVideoEvent(WaMulti::class, 'message.video', $request->all()));
    }

    /**
     * handler event message audio
     *
     * @param Request $request
     * @return void
     */
    public function messageAudio(Request $request)
    {
        event(new MessageAudioEvent(WaMulti::class, 'message.audio', $request->all()));
    }

    /**
     * handler event message doc
     *
     * @param Request $request
     * @return void
     */
    public function messageDoc(Request $request)
    {
        event(new MessageDocEvent(WaMulti::class, 'message.doc', $request->all()));
    }

    /**
     * handler event message contact
     *
     * @param Request $request
     * @return void
     */
    public function messageContact(Request $request)
    {
        event(new MessageContactEvent(WaMulti::class, 'message.contact', $request->all()));
    }

    /**
     * handler event message location
     *
     * @param Request $request
     * @return void
     */
    public function messageLocation(Request $request)
    {
        event(new MessageLocationEvent(WaMulti::class, 'message.location', $request->all()));
    }
}
