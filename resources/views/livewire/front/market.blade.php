<div>
    @section('title', __('Stores'))
    <section>
        <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
            <div class="flex items-center justify-center -mt-2 pb-0.5 mb-4 md:mb-5 lg:mb-6 2xl:mb-7 3xl:mb-8">
                <h3 class="text-lg pt-5 md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                    {{ __('Vendors') }}
                </h3>
            </div>
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

            {{-- filter by city or location or distance --}}

            <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($stores as $vendor)
                    <div class="mx-auto relative overflow-hidden">
                        <div class="relative w-auto px-4 py-10 rounded-md bg-white mx-6 mt-4  bg-opacity-75">
                            @if ($vendor->banner_image)
                                <img src="{{ asset('uploads/' . $vendor->banner_image) }}"
                                    alt="{{ $vendor->company_name }}" class="w-full object-cover" />
                            @endif
                            <div class="flex flex-col items-center gap-4 mb-5">
                                @if ($vendor->logo)
                                    <img src="{{ $vendor->logo }}" alt="{{ $vendor->name }} logo"
                                        class="w-24 h-24 mr-3">
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
                @endforeach
            </div>
        </div>
    </section>
</div>
