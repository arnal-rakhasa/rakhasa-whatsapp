<?php

namespace Rakhasa\Whatsapp\Concerns;

trait HasRequest
{
    /**
     * Validate request array
     *
     * @param array $data
     * @return array
     */
    public function validateRequest(array $data): array
    {
        $cleanData = [];

        foreach ($data as $key => $value) {
            $cleanData[$key] = $value;
        }

        return $cleanData;
    }
}
