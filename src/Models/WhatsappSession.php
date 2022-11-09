<?php

namespace Rakhasa\Whatsapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakhasa\Whatsapp\Concerns\Sessionable;
use Rakhasa\Whatsapp\Concerns\Uuids;
use Rakhasa\Whatsapp\Contracts\SessionModel;

class WhatsappSession extends Model implements SessionModel
{
    use HasFactory, Uuids, Sessionable;

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'session_id',
        'number',
        'name',
        'proxy_url',
        'is_connected',
        'whatsapp_host_id',
        'is_active',
        'last_event',
        'last_message',
    ];
}
