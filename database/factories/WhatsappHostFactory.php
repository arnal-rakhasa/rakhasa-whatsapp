<?php

namespace Rakhasa\Whatsapp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WhatsappHostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $source = config('rakhasa-whatsapp.source.list');
        return [
            'host' => $this->faker->domainName(),
            'is_active' => rand(0, 1),
            'source' => $source[rand(0, count($source) - 1)]
        ];
    }
}
