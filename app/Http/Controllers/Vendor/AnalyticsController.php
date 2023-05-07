<?php

declare(strict_types=1);

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('vendor.account.index');
    }
}
