<?php

use Illuminate\Support\Facades\Route;

foreach (config('rakhasa-whatsapp.webhook') as $webhook) {

    foreach ($webhook['routes'] as $route => $controller) {
        Route::post($route, $controller);
    }

}
