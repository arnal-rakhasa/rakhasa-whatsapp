<?php

namespace Rakhasa\Whatsapp;

use Rakhasa\Whatsapp\Events\WhatsappWebhookEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener;

class WhatsappEventServiceProvider extends ServiceProvider
{
    public function listens()
    {
        return config('rakhasa-whatsapp.events');
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
