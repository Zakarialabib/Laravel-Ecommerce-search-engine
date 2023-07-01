<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $id)
    {
        $product = Product::findorfail($id);

        return view('front.product', compact('product'));
    }
}
