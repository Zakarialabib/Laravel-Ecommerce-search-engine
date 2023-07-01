<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Integrations;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Shopify\ShopifyApi;

class Shopify extends Component
{
    public $shopUrl;
    public $apiKey;
    public $apiPassword;
    public $accessToken;
    public $products = [];

    public function mount(): void
    {
        $this->shopUrl = config('shopify.shop_url');
        $this->apiKey = config('shopify.api_key');
        $this->apiPassword = config('shopify.api_password');
    }

    public function authenticate()
    {
        // Redirect user to Shopify authorization page
        $shopify = ShopifyApp::shop();
        $redirectUrl = $shopify->buildAuthUrl();

        return redirect()->to($redirectUrl);
    }

    public function callback()
    {
        // Verify request is coming from Shopify
        $hmac = $request->header('x-shopify-hmac-sha256');
        $data = $request->getContent();
        $verified = ShopifyApp::verifyRequest($data, $hmac);

        if (! $verified) {
            abort(401, 'Unauthorized');
        }

        // Exchange authorization code for access token
        $shopify = ShopifyApp::shop();
        $accessToken = $shopify->getAccessToken($request->input('code'));

        // Save access token to database
        $integration = Integration::where('store_url', $shopify->getShop())->first();

        if (! $integration) {
            $integration = new Integration();
            $integration->store_url = $shopify->getShop();
        }
        $integration->access_token = $accessToken;
        $integration->save();

        return redirect()->route('dashboard');
    }

    public function syncProducts(): void
    {
        $api = new ShopifyApi(['shopUrl' => $this->shopUrl, 'accessToken' => $this->accessToken]);
        $this->products = $api->rest('GET', '/admin/api/2021-09/products.json')['body']['products'];
        // Do something with the products data...
    }

    public function render(): View
    {
        return view('livewire.vendor.integrations.shopify');
    }
}
