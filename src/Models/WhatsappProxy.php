<?php

namespace Rakhasa\Whatsapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakhasa\Whatsapp\Concerns\Proxiable;
use Rakhasa\Whatsapp\Concerns\Uuids;
use Rakhasa\Whatsapp\Contracts\ProxyModel;

class WhatsappProxy extends Model implements ProxyModel
{
    use HasFactory, Uuids, Proxiable;

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'description',
        'host',
        'username',
        'password',
        'is_active',
    ];
}
