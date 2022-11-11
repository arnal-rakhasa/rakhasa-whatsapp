<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Source Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration for sources. You can config default
    | source in this config, when source not provided when init the class,
    | the default will use as the source on init source parameters.
    |
    | Note: you see the list of sources in src/Sources directory.
    |
    */

    'source' => [
        'default' => \Rakhasa\Whatsapp\Sources\WaMulti::class,
        'list' => [
            'wa-multi' => \Rakhasa\Whatsapp\Sources\WaMulti::class,
            'wabot' => \Rakhasa\Whatsapp\Sources\Wabot::class,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration for webhook like route, controller
    | and method controller. Alternatively you can publish this config and
    | define your custom config manually according to your own app.
    |
    */

    'webhook' => [
        \Rakhasa\Whatsapp\Sources\WaMulti::class => [
            'base' => env('BASE_WEBHOOK_WAMULTI_URL', url('webhook/whatsapp/wa-multi')),
            'routes' => [
                'webhook/whatsapp/wa-multi/notify/logout' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'notifyLogout'],
                'webhook/whatsapp/wa-multi/notify/receive' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'notifyReceive'],
                'webhook/whatsapp/wa-multi/notify/connectivity' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'notifyConnectivity'],
                'webhook/whatsapp/wa-multi/message/text' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageText'],
                'webhook/whatsapp/wa-multi/message/image' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageImage'],
                'webhook/whatsapp/wa-multi/message/video' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageVideo'],
                'webhook/whatsapp/wa-multi/message/audio' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageAudio'],
                'webhook/whatsapp/wa-multi/message/doc' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageDoc'],
                'webhook/whatsapp/wa-multi/message/contact' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageContact'],
                'webhook/whatsapp/wa-multi/message/location' => [\Rakhasa\Whatsapp\Http\Controllers\WaMultiWebhookController::class, 'messageLocation'],
            ],
        ],
        \Rakhasa\Whatsapp\Sources\Wabot::class => [
            'base' => env('BASE_WEBHOOK_WABOT_URL', url('webhook/whatsapp/wabot')),
            'routes' => [
                'webhook/whatsapp/wabot/notify/logout' => [\Rakhasa\Whatsapp\Http\Controllers\WabotWebhookController::class, 'notifyLogout'],
                'webhook/whatsapp/wabot/notify/receive' => [\Rakhasa\Whatsapp\Http\Controllers\WabotWebhookController::class, 'notifyReceive'],
                'webhook/whatsapp/wabot/notify/connectivity' => [\Rakhasa\Whatsapp\Http\Controllers\WabotWebhookController::class, 'notifyConnectivity'],
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration for event dispatched by controller.
    | basically you don't need to custom this config, but there some case
    | when you need to custom this value like you want to make custom
    | listener for every event dispatched by webhook controller.
    |
    */

    'events' => [
        \Rakhasa\Whatsapp\Events\NotifyLogoutEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\NotifyReceiveEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\NotifyConnectivityEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageTextEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageImageEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageVideoEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageAudioEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageDocEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageContactEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
        \Rakhasa\Whatsapp\Events\MessageLocationEvent::class => [
            \Rakhasa\Whatsapp\Listeners\WhatsappWebhookListener::class
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Handler Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration handler for every source available.
    | you can make your own handler by change to handler for certain source.
    |
    */

    'handlers' => [
        \Rakhasa\Whatsapp\Sources\WaMulti::class => \Rakhasa\Whatsapp\Handlers\WaMultiHandler::class,
        \Rakhasa\Whatsapp\Sources\Wabot::class => \Rakhasa\Whatsapp\Handlers\WabotHandler::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration of models of each table in package.
    | At some point if you may need to create your custom model for more
    | flexible configuration like add more column to current migration.
    |
    */

    'models' => [
        'host' => \Rakhasa\Whatsapp\Models\WhatsappHost::class,
        'proxy' => \Rakhasa\Whatsapp\Models\WhatsappProxy::class,
        'session' => \Rakhasa\Whatsapp\Models\WhatsappSession::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth Config
    |--------------------------------------------------------------------------
    |
    | This value is contains configuration of authentication of certain source
    | like list of available authentication and other configuration. You may
    | add your own authentication if you have custom auth implementation.
    |
    */

    'auth' => [
        'list' => [
            'none' => \Rakhasa\Whatsapp\Auth\None::class,
            'api_token' => \Rakhasa\Whatsapp\Auth\APIToken::class,
            'api_key' => \Rakhasa\Whatsapp\Auth\APIKey::class
        ]
    ]
];
