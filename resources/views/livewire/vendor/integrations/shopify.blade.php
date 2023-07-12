<div>
    @if ($accessToken)
        <p>{{__('Access token')}}: {{ $accessToken }}</p>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['title'] }}</td>
                        <td>{{ $product['variants'][0]['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <form wire:submit.prevent="authorize">
            <label for="shop_url">Shop URL:</label>
            <input type="text" id="shop_url" name="shop_url" wire:model.defer="shopUrl">
            <button type="submit">Authorize with Shopify</button>
        </form>
    @endif
</div>
