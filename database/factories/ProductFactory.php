<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productName = $this->faker->unique()->words($nb = 3, $asText = true);
        $productDescription = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        $productPrice = $this->faker->numberBetween($min = 10, $max = 1000);
        $productCode = Str::random(5);
        $productSlug = Str::slug($productName);

        return [
            'name'             => $productName,
            'description'      => $productDescription,
            'price'            => $productPrice,
            'image'            => 'samsung-galaxy-s21.jpg',
            'code'             => $productCode,
            'category_id'      => 1,
            'user_id'         => 1,
            'brand_id'         => 1,
            'url'              => 'www.hotech.ma',
            'slug'             => $productSlug,
            'meta_title'       => $productName,
            'meta_description' => $productDescription,
            'meta_keywords'    => $this->faker->words($nb = 3, $asText = true),
            'status'           => $this->faker->boolean(90),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $store = Store::inRandomOrder()->first();
            $product->store()->associate($store);
            $product->save();
        });
    }
}
