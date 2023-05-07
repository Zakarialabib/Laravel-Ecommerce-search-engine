<?php

declare(strict_types=1);

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

class Productontroller extends Controller
{
    public function index()
    {
        return view('vendor.product.index');
    }

    public function productSync()
    {
        
        $apiUrl = '127.0.0.1:8000/api/v1/';
        $apiKey = '1otDa9wrzJZNywwbFNLaGgb7TZi9gbBV8JfMOLhRtf9hpzQAkYDH6XJXMBxL';

        $data = Http::withBasicAuth('omar@taibalharamain.ma', 'password')->get( $apiUrl ."products" . $apiKey);
        
        dd($data);
            
        return view('vendor.product.product-import', $data);
    }
}
