<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Response
    {
        return new ProductCollection(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        $product = Product::create([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'slug' => $request->slug,
            'category_id' => Category::create(['name' => $request->category_id])->id ?? null,
            'meta_title' => $request->name,
            'status' => false,
        ]);

        return new ProductResource($product);
    }

    public function bulkStore(ProductRequest $request)
    {
        $products = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['categoryId']);
        });

        try {
            Product::insert($products->toArray());
            Log::info('Bulk store operation completed successfully.');

            return response()->json(['message' => 'Products uploaded successfully.']);
        } catch (Exception $e) {
            Log::warning('Bulk store operation failed: '.$e->getMessage());

            return response()->json(['message' => 'Failed to upload products.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Product $product): \Illuminate\Http\Response
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {
    }
}
