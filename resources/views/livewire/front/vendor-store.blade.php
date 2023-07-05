<div>
    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title" content="{{ $vendor->name }}">
        {{-- <meta property="og:description" content="{!! $vendor->meta_description !!}"> --}}
        <meta property="og:url" content="{{ URL::current() }}">
        <meta property="og:image" content="{{ asset('images/vendors/' . $vendor->logo) }}">
    @endsection
    
    <div class="flex flex-col lg:flex-row-reverse">
        <div class="w-full sm:w-full md:w-full lg:w-1/4 h-auto mx-auto relative overflow-hidden" x-data="{ showSidebar: false }">
            <div class="relative w-auto px-4 py-10 rounded-md bg-white mx-6 mt-4  bg-opacity-75">
                @if ($vendor->banner_image)
                    <img src="{{ asset('uploads/' . $vendor->banner_image) }}" alt="{{ $vendor->company_name }}"
                        class="w-full object-cover" />
                @endif
                <div class="flex flex-col items-center gap-4 mb-5">
                    @if ($vendor->logo)
                        <img src="{{ $vendor->logo }}" alt="{{ $vendor->name }} logo" class="w-24 h-24 mr-3">
                    @endif
                    <h1 class="text-3xl font-bold">{{ $vendor->name }}</h1>
                </div>
                <hr class="my-5">
                <div class="flex items-center justify-center lg:justify-start mb-5">
                    <a href="tel:{{ $vendor->phone }}" class="text-blue-500 mr-3">
                        <i class="fas fa-phone"></i>
                    </a>
                    <p class="text-sm">{{ $vendor->phone }}</p>
                </div>
                <div class="flex items-center justify-center lg:justify-start mb-5">
                    <a href="{{ $vendor->url }}" target="__blank" class="text-blue-500 mr-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <p class="text-sm">{{ $vendor->location }}</p>
                </div>
                {{-- views --}}
                @if ($vendor->social_links)
                    <div class="flex items-center justify-center mb-5">
                        @foreach ($vendor->social_links as $link)
                            <a href="{{ $link['url'] }}" target="__blank" class="text-blue-500 mr-3">
                                <i class="{{ $link['icon'] }}"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <div class="w-full px-6 mt-4" x-data="{ loading: false }">
                <div class="flex flex-wrap justify-start gap-4 items-center w-full py-4 px-6 bg-white opacity-75 lg:w-auto ">
                    <select wire:model="perPage" name="perPage"
                        class="lg:px-4 md:px-2 py-3 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-move-500">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <select
                        class="lg:px-4 md:px-2 py-3 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-move-500"
                        id="sortBy" wire:model="sorting">
                        <option selected>{{ __('Choose filters') }}</option>
                        @foreach ($sortingOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <div>
                        <x-input type="text" wire:model.debounce.300ms="search" placeholder="{{ __('Search') }}"
                            autofocus />
                    </div>
                </div>
                <div class="grid gap-6 lg:grid-cols-4 sm:grid-cols-2 mt-4 mb-10">
                    @forelse ($products as $product)
                        <x-product-card :product="$product" :vendor="$vendor" />
                    @empty
                        <div class="col-span-full">
                            <h3 class="text-3xl font-bold font-heading text-blue-900">
                                {{ __('No products found') }}
                            </h3>
                        </div>
                    @endforelse
                </div>
                <div class="flex justify-center mt-10" x-show="!loading && '{{ $products->hasMorePages() }}'">
                    <div x-intersect="() => { $wire.loadMore(() => loading = false) }"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 transform translate-y-10"
                        x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex items-center justify-center text-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4" fill="none">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM20 12a8 8 0 01-8 8v4c4.627 0 10-5.373 10-12h-4zm-2-5.291A7.962 7.962 0 0120 12h4c0-3.042-1.135-5.824-3-7.938l-3 2.647z">
                                </path>
                            </svg>
                            <span>{{ __('Loading...') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
