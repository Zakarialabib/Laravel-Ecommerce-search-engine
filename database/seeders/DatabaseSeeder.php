<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(10)->create();

        $stores = Store::factory()->count(10)->create([
            'user_id' => function () use ($users) {
                return $users->random()->id;
            },
        ]);

        $this->call([

            CurrenciesSeeder::class,
            LanguagesSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SettingSeeder::class,
            FeaturedBannerSeeder::class,
            ServiceSeeder::class,
            // SliderSeeder::class,
            // RolesSeeder::class,
            PermissionsDemoSeeder::class,
            PermissionsSeeder::class,
            SubscriptionSeeder::class,

        ]);
    }
}
