<div>
    <section
        class="bg-gradient-to-t from-transparent to-white/[55%] py-12 dark:bg-gradient-to-b dark:from-white/5 dark:to-transparent lg:py-24">
        <div class="flex px-6">
            <div class="w-3/4 sm:w-full lg:w-3/4">
                <div class="heading mb-0 text-center">
                    <h6>{{ __('Subscription Plan') }}</h6>
                    <h4>{{ __('Choose the package that suits your needs') }}</h4>
                </div>
                <div class="mt-14 grid grid-cols-1 justify-between gap-10 sm:grid-cols-2 md:mt-20 lg:grid-cols-3 lg:gap-7 aos-init aos-animate"
                    data-aos="fade-up" data-aos-duration="1000">
                    @foreach ($this->subscriptions as $subscription)
                        <div class="group relative space-y-6 rounded-lg border-2 border-indigo-600 bg-white py-6 px-5 duration-200 hover:bg-indigo-600 hover:text-black dark:border-gray/[0.1] dark:bg-gray-dark dark:hover:border-indigo-700"
                            x-data="{ selected: false }" x-bind:class="{ 'border-indigo-700': selected }"
                            x-on:click="selected = !selected">
                            <div
                                class="item-center absolute -top-[30px] left-1/2 mx-auto inline-flex -translate-x-1/2 justify-between rounded-xl bg-indigo-700 py-2 px-6 text-white">
                                <h5 class="text-xl font-black uppercase">{{ $subscription->name }}</h5>
                            </div>
                            @foreach ($subscription->features as $index => $feature)
                                <div class="flex items-center gap-2">
                                    <div>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" fill="#45B649">
                                            </circle>
                                            <path d="M5.11438 8.11438L7 10L10.7712 6.22876" stroke="white"
                                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm hover:text-white focus:text-white font-bold">
                                            {{ $feature }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <hr class="my-7 h-[2px] bg-gray/10" />
                            <div class="text-center">
                                <p>
                                    {{ $subscription->price }}DH<span
                                        class="text-sm font-bold">/{{ $subscription->duration }}</span>
                                </p>
                                <x-button type="button" primary wire:click="selectPlan({{ $subscription->id }})">
                                    {{ __('Select Plan') }}
                                </x-button>
                            </div>
                            <h5 class="font-blod mt-4 text-center text-sm text-black group-hover:text-white">
                                {{ __('Billed every') }} {{ $subscription->plan }}
                            </h5>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-1/4 sm:w-full lg:w-1/4 ml-6 bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4">
                    <h4 class="text-lg font-semibold mb-4">{{ __('Selected Plan') }}</h4>
                    @if ($selectedPlan)
                        <div class="mb-4">
                            <h6 class="text-sm font-semibold">{{ __('Payment Method') }}:</h6>
                            <p class="text-sm text-gray-500">{{ $payment_method }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="text-base font-semibold">{{ $selectedPlan->name }}</h5>
                            <p class="text-sm text-gray-500">{{ $selectedPlan->description }}</p>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-sm font-semibold">{{ __('Features') }}:</h6>
                            <ul class="text-sm text-gray-500 list-disc list-inside">
                                @foreach ($selectedPlan->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-sm font-semibold">{{ __('Price') }}:</h6>
                            <p class="text-lg font-bold">{{ $selectedPlan->price }}</p>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-sm font-semibold">{{ __('Starting Date') }}:</h6>
                            <p class="text-sm text-gray-500">{{ $startsAt }}</p>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-sm font-semibold">{{ __('End Date') }}:</h6>
                            <p class="text-sm text-gray-500">{{ $endsAt }}</p>
                        </div>
                    @else
                        <p>{{ __('No plan selected') }}</p>
                    @endif
                    <div class="text-center mt-8">
                        <button type="button" class="btn py-2 px-6 bg-indigo-600 text-white font-semibold"
                            wire:click="confirmSubscription">
                            {{ __('Confirm Subscription') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
