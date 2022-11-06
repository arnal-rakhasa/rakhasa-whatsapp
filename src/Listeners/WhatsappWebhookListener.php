<?php

namespace Rakhasa\Whatsapp\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Rakhasa\Whatsapp\Whatsapp;

class WhatsappWebhookListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $source = $event->source;
        $type = $event->type;
        $data = $event->data;

        if (in_array($source, config('rakhasa-whatsapp.source.list'))) {
            $handlerClass = config('rakhasa-whatsapp.handlers')[$source];

            $handler = new $handlerClass;
            $handler->listen($type, $data);
        }
    }
}
