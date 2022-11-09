<?php

namespace Rakhasa\Whatsapp\Contracts;

interface ProxyModel
{
    /**
     * scope only active host
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder;

    /**
     * Get reformed proxy url
     *
     * @return string
     */
    public function getProxyUrl(): string;

    /**
     * Get list session use this proxy
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhatsappSession(): \Illuminate\Database\Eloquent\Collection;
}
