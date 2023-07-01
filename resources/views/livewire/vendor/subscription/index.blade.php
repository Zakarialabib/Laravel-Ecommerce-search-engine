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
                <div class="mb-4"
                    <h6 class="text-sm font-semibold">{{ __('Payment Method') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $userSubscription->order->payment_method }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Payment Status') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $userSubscription->order->payment_status }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Price') }}:</h6>
                    <p class="text-lg font-bold">{{ $userSubscription->order->amount }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Starting Date') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $userSubscription->start_date }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('End Date') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $userSubscription->ends_date }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-sm font-semibold">{{ __('Description') }}:</h6>
                    <p class="text-sm text-gray-500">{{ $userSubscription->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
