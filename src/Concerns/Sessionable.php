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
     * Get used whatsapp session
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsed(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_used', 1);
    }

    /**
     * Get unused whatsapp session
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnused(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_used', 0);
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
    public function safeUpdate(bool $isConnected, string $name, string $number, string $reason, string $lastEvent): void
    {
        $this->is_connected = $isConnected;
        $this->name = $name;
        $this->number = $number;
        $this->last_message = $reason;
        $this->last_event = $lastEvent;
        $this->save();
    }

    /**
     * Marked whatsapp session as used
     *
     * @return void
     */
    public function startBot(): void
    {
        $this->is_used = 1;
        $this->save();
    }

    /**
     * Unmarked whatsapp session as used
     *
     * @return void
     */
    public function stopBot(): void
    {
        $this->is_used = 0;
        $this->save();
    }
}
