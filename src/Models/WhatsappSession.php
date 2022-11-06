<?php

namespace Rakhasa\Whatsapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakhasa\Whatsapp\Concerns\Uuids;

class WhatsappSession extends Model
{
    use HasFactory, Uuids;

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

    /**
     * include relation whatsapp host
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whatsappHost(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('rakhasa-whatsapp.models.host'));
    }
}
