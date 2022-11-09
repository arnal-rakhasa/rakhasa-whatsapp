<?php

namespace Rakhasa\Whatsapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakhasa\Whatsapp\Concerns\Uuids;
use Rakhasa\Whatsapp\Contracts\HostModel;

class WhatsappHost extends Model implements HostModel
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
        'source',
        'auth',
        'properties'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'properties' => 'array',
    ];

    /**
     * scope only active host
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * include relation whatsapp sessions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whatsappSessions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config('rakhasa-whatsapp.models.session'));
    }
}
