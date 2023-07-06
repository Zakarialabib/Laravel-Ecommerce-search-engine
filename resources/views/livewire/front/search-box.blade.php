<div class="relative w-full h-full">
    <div class="h-[3rem] w-auto xl:w-[28rem] lg:w-[20rem] md:w-[15rem]">
        <x-input wire:model.debounce.300ms="query" type="text"
            class="w-full h-full py-2 pl-10 rounded-md"
            placeholder="{{ __('Search for products or devices') }}..." />
        <button wire:click="clear" class="bg-gray-100 h-full">
            <svg class="w-4 h-4 absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-900"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @if (count($results) > 0)
        <div class="absolute top-10 left-0 w-full bg-white text-black rounded z-50"
            x-transition:enter="transition-all duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-all"
            x-transition:leave-start="opacity-25" x-transition:leave-end="opacity-0 hidden" x-cloak>
            @if (count($results['products']) > 0)
                <div class="w-full text-center p-2 font-semibold">
                    {{ __('Products') }}
                </div>
                <hr class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200 border-b border-x border-gray-500 drop-shadow-md">
                    @foreach ($results['products'] as $product)
                        <li class="p-2 text-black hover:bg-gray-100">
                            <a href="{{ route('front.product', $product->slug) }}" class="flex gap-8 items-center">
                                <span class="font-bold">
                                    {{ $product->name }}
                                </span>
                                @if ($product->store)
                                    <span>
                                        {{ __('Store') }} : {{ $product->store?->name }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                    @if (count($results['products']) >= $perPage)
                        <li class="flex justify-center">
                            <button class="w-full text-white bg-indigo-600 py-2 text-center"
                                wire:click="loadMore">{{ __('Load More') }}</button>
                        </li>
                    @endif
                </ul>
            @endif

            @if (count($results['deviceModels']) > 0)
                <div class="w-full text-center p-2 font-semibold">
                    {{ __('Devices') }}
                </div>
                <hr class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200 border-b border-x border-gray-500 drop-shadow-md">
                    @foreach ($results['deviceModels'] as $deviceModel)
                        <li class="p-2 text-black hover:bg-gray-100">
                            <a href="{{ route('front.deviceshow' , $deviceModel->slug) }}"
                                class="flex gap-8 items-center">
                                <span class="font-bold">
                                    {{ $deviceModel->name }}
                                </span>
                                @if ($deviceModel->brand_id)
                                    <span>
                                        {{ __('Brand') }} : {{ $deviceModel->brand?->name }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                    @if (count($results['deviceModels']) >= $perPage)
                        <li class="flex justify-center">
                            <button class="w-full text-white bg-indigo-600 py-2 text-center" wire:click="loadMore">
                                {{ __('Load More') }}</button>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    @endif
</div>
