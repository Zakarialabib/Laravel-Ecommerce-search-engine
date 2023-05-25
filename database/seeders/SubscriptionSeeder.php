<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Subscription::insert([
            [
                'id'        => 1,
                'name' => $this->faker->word,
                'description' => $this->faker->sentence,
                'features' => ['Feature 1', 'Feature 2', 'Feature 3'],
                'plan' => 'Trial',
                'duration' => 7,
                'price' => 0,
                'old_price' => 0,
                'trial_duration' => 7,
                'status' => 'active',
            ],
            [
                'id'        => 2,
                'name' => $this->faker->word,
                'description' => $this->faker->sentence,
                'features' => ['Feature 1', 'Feature 2', 'Feature 3'],
                'plan' => 'Monthly',
                'price' => 249,
                'old_price' => 499,
                'duration' => '30',
                'trial_duration' => '7',
                'status' => 'active',
            ],
            [
                'id'        => 3,
                'name' => $this->faker->word,
                'description' => $this->faker->sentence,
                'features' => ['Feature 1', 'Feature 2', 'Feature 3'],
                'plan' => 'Yearly',
                'price' => 2499,
                'old_price' => 3250,
                'duration' => '365',
                'trial_duration' => '15',
                'status' => 'active',
            ],
        ]);
    }
}
