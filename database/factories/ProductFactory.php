<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Price;
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
        $productCode = Str::random(5);
        $productSlug = Str::slug($productName);

        return [
            'name'             => $productName,
            'description'      => $productDescription,
            'image'            => 'samsung-galaxy-s21.jpg',
            'code'             => $productCode,
            'category_id'      => 1,
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

            $price = Price::create([
                'price'            => $this->faker->numberBetween($min = 10, $max = 1000),
                'old_price'        => $this->faker->numberBetween($min = 10, $max = 1000),
                'wholesale_price'  => $this->faker->numberBetween($min = 10, $max = 1000),
                'suggested_prices' => [],
                'product_id'       => $product->id,
                'status'           => true,
            ]);

            // Associate the price with the product
            $product->price_id = $price->id;
            $product->save();
        });
    }
}
