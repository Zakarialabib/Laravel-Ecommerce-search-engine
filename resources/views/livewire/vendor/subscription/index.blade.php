<div>
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Your Subscription') }}
                </h6>
            </div>
        </div>

        <div class="mt-4">

            <div class="px-6 py-4">
                <h4 class="text-lg font-semibold mb-4">{{ __('Selected Plan') }}</h4>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Payment Method') }}:</h6>
                    @dd($subscription)
                    <p class="text-sm text-gray-500">{{ $subscription->store->payment_method }}</p>
                </div>
                <div class="mb-4">
                    <h5 class="text-base font-semibold">{{ $subscription->name }}</h5>
                    <p class="text-sm text-gray-500">{{ $subscription->description }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Features') }}:</h6>
                    <ul class="text-sm text-gray-500 list-disc list-inside">
                        @foreach ($subscription->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Price') }}:</h6>
                    <p class="text-lg font-bold">{{ $subscription->price }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Starting Date') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $subscription->start_date }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('End Date') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $subscription->ends_date }}</p>
                </div>
                <div class="text-center mt-8">
                    <button type="button" class="btn py-2 px-6 bg-indigo-600 text-white font-semibold"
                        wire:click="confirmSubscription">
                        {{ __('Confirm Subscription') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
