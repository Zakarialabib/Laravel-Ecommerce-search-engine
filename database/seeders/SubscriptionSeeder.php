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
                'title'     => 'local',
            ],
        ]);
    }
}
