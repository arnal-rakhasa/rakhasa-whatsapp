<?php

namespace Rakhasa\Whatsapp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rakhasa\Whatsapp\Whatsapp
 */
class Whatsapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rakhasa\Whatsapp\Whatsapp::class;
    }
}
