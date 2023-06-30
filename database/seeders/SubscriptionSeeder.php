<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'id'             => 1,
                'uuid'           => Str::uuid(),
                'name'           => 'starter plan',
                'description'    => 'description',
                'features'       => json_encode(['Feature 1', 'Feature 2', 'Feature 3']),
                'plan'           => 'Trial',
                'price'          => 0,
                'duration'       => 7,
                'trial_duration' => 7,
                'status'         => true,
            ],
            [
                'id'             => 2,
                'uuid'           => Str::uuid(),
                'name'           => 'growth plan',
                'description'    => 'description',
                'features'       => json_encode(['Feature 1', 'Feature 2', 'Feature 3']),
                'plan'           => 'Monthly',
                'price'          => 349,
                'duration'       => '30',
                'trial_duration' => '7',
                'status'         => true,
            ],
            [
                'id'             => 3,
                'uuid'           => Str::uuid(),
                'name'           => 'Pro plan',
                'description'    => 'description',
                'features'       => json_encode(['Feature 1', 'Feature 2', 'Feature 3']),
                'plan'           => 'Yearly',
                'price'          => 2449,
                'duration'       => '365',
                'trial_duration' => '15',
                'status'         => true,
            ],
        ]);
    }
}
