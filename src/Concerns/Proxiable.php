<?php

namespace Rakhasa\Whatsapp\Concerns;

trait Proxiable
{
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
     * Get reformed proxy url
     *
     * @return string
     */
    public function getProxyUrl(): string
    {
        $url = parse_url($this->host);

        $proxyUrl = '';
        $proxyUrl .= isset($url['scheme']) ? $url['scheme'] . '://' : '';
        $proxyUrl .= $this->username . ':' . $this->password . '@';
        $proxyUrl .= isset($url['host']) ? $url['host'] : '';
        $proxyUrl .= isset($url['port']) ? ':' . $url['port'] : '';

        return $proxyUrl;
    }

    /**
     * Get list session use this proxy
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhatsappSession(): \Illuminate\Database\Eloquent\Collection
    {
        return config('rakhasa-whatsapp.models.session')::where('proxy_url', $this->getProxyUrl())->get();
    }
}
