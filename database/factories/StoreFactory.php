<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class StoreFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'location' => $this->faker->address,
            'status'=>$this->faker->boolean(),
            'banner_image' => $this->faker->imageUrl(640, 480, 'business'),
            'logo' => $this->faker->imageUrl(200, 200, 'business'),
        ];
    }
}
