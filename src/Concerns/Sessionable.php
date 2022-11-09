<?php

namespace Rakhasa\Whatsapp\Concerns;

use Illuminate\Database\Eloquent\SoftDeletes;

trait Sessionable
{
    use SoftDeletes;

    /**
     * scope only active host
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', 1);
    }

    /**
     * include relation whatsapp host
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whatsappHost(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('rakhasa-whatsapp.models.host'));
    }

    /**
     * Check is session connected
     *
     * @return boolean
     */
    public function isConnected(): bool
    {
        return $this->is_connected == true;
    }

    /**
     * Safely update session
     *
     * @param array $data
     * @param string $lastEvent
     * @return void
     */
    public function safeUpdate(array $data, string $lastEvent): void
    {
        $this->is_connected = $data['isConnected'];
        if ($data['pushName']) {
            $this->name = $data['pushName'];
        }
        $this->number = $data['number'];
        $this->last_event = $lastEvent;
        $this->last_message = $data['reason'];
        $this->save();
    }
}
