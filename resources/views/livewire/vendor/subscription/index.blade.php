<div>
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="py-8 bg-gray-100">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap items-center justify-between -mx-4">
                    <div class="w-full md:w-auto px-4 mb-14 md:mb-0">
                        <h2 class="text-7xl md:text-8xl font-heading font-bold leading-relaxed">
                            {{ __('My Subscription') }}</h2>
                        <p class="text-gray-400 leading-8">
                            {{ 'Manage subscription and set preferences.' }}
                        </p>
                    </div>
                    <div class="w-full md:w-auto px-4">
                        <div class="flex items-center">
                            {{-- <x-button primary type="button" wire:click="store" wire:loading.attr="disabled">
                                {{ __('Save') }}
                            </x-button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="pt-24 bg-white">
            <div class="relative -mb-40 py-16 px-4 md:px-8 lg:px-16 bg-coolGray-800 rounded-md overflow-hidden">
                <ul class="flex items-center gap-2 self-start px-8">
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('Payment Method') }}:</h6>
                        <p class="text-sm text-gray-500">{{ $userSubscription->order->payment_method }}</p>
                    </li>
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('Payment Status') }}:</h6>
                        <p class="text-sm text-gray-500">{{ $userSubscription->order->payment_status }}</p>
                    </li>
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('Price') }}:</h6>
                        <p class="text-lg font-bold">{{ $userSubscription->order->amount }}</p>
                    </li>
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('Starting Date') }}:</h6>
                        <p class="text-sm text-gray-500">{{ $userSubscription->start_date }}</p>
                    </li>
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('End Date') }}:</h6>
                        <p class="text-sm text-gray-500">{{ $userSubscription->ends_date }}</p>
                    </li>
                    <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                        <h6 class="text-sm font-semibold">{{ __('Description') }}:</h6>
                        <p class="text-sm text-gray-500">{{ $userSubscription->description }}</p>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>
