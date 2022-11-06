<?php

namespace Rakhasa\Whatsapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakhasa\Whatsapp\Concerns\Uuids;

class WhatsappHost extends Model
{
    use HasFactory, Uuids;

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'host',
        'is_active',
        'source'
    ];
}
