<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class SubscriptionFactory extends Factory
{
    public function definition()
    {
        return [
            'name'           => $this->faker->word,
            'description'    => $this->faker->sentence,
            'features'       => ['Feature 1', 'Feature 2', 'Feature 3'],
            'plan'           => $this->faker->randomElement(['Trial', 'Monthly', 'Yearly']),
            'duration'       => $this->faker->numberBetween(1, 12),
            'trial_duration' => $this->faker->numberBetween(1, 12),
            'status'         => 'active',
        ];
    }
}
