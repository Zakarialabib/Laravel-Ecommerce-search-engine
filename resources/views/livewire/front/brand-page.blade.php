<div>

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title" content="{{ $brand->meta_title }}">
        <meta property="og:description" content="{!! $brand->meta_description !!}">
        <meta property="og:url" content="{{ URL::current() }}">
        <meta property="og:image" content="{{ asset('images/brands/' . $brand->image) }}">
    @endsection
    
    @section('title', $brand?->name)

    <section class="py-5 px-4 bg-gray-100 w-full mx-auto" x-data="{ showSidebar: false }">

        <div class="relative bg-white overflow-hidden mt-5">
            <img class="absolute right-0 top-0 md:w-1/2 sm:w-full h-full object-cover"
                src="{{ asset('images/brands/' . $brand->featured_image) }}" alt="{{ $brand->name }}" loading="lazy">
            <div class="relative max-w-xl pl-6 lg:pl-20 py-10 bg-white bg-opactity-75">
                <span
                    class="px-3 py-1 border border-blue-500 rounded-full text-xs text-blue-500 font-bold font-heading uppercase">
                    {{ $brand->name }}
                </span>
                <div class="mt-6 mb-8">
                    <img class="h-auto" src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}"
                        loading="lazy">
                </div>
                <p class="mb-10 px-5 text-md text-gray-800">
                    {{ $brand->description }}
                </p>
                <div class="w-full lg:w-auto justify-center gap-2 lg:mb-4 px-4 flex flex-wrap items-center">
                    <select wire:model="perPage" name="perPage"
                        class="lg:px-4 md:px-2 py-2 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-move-500">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <select
                        class="lg:px-4 md:px-2 py-2 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-move-500"
                        id="sortBy" wire:model="sorting">
                        <option selected>{{ __('Choose filters') }}</option>
                        @foreach ($sortingOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full px-10 py-4 my-5 bg-white rounded-lg">
            <h3
                class="py-5 text-3xl md:text-4xl lg:text-5xl leading-tight text-indigo-600 text-center font-bold tracking-tighter uppercase cursor-pointer">
                <span class="hover:underline transition duration-200 ease-in-out">
                    {{ __('Devices') }} {{ $brand->name }}
                </span>
            </h3>
            <div class="grid gap-6 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 xs:grid-cols-2 my-10"
                wire:loading.class="opacity-50" wire:target="loadMoreDeviceModels">
                @forelse ($deviceModels as $deviceModel)
                    <x-deviceModel-card :deviceModel="$deviceModel" />
                @empty
                    <div class="col-span-full text-center">
                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                            {{ __('No brand devices found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
            @if ($deviceModels->isEmpty())
                <div class="flex justify-center text-center">
                    <x-button primary type="button" wire:click="loadMoreDeviceModels" wire:loading.attr="disabled">
                        {{ __('Load more devices') }}
                    </x-button>
                </div>
            @endif
        </div>

        <div class="w-full px-10 py-4 my-5 bg-white rounded-lg">
            <h3
                class="py-5 text-3xl md:text-4xl lg:text-5xl leading-tight text-indigo-600 text-center font-bold tracking-tighter uppercase cursor-pointer">
                <span class="hover:underline transition duration-200 ease-in-out">
                    {{ __('Products') }} {{ $brand->name }}
                </span>
            </h3>
            <div class="my-4 flex gap-4 justify-center">
                @foreach ($categories as $category)
                    <x-button primary type="button" wire:click="selectedCategory({{ $category->id }})"
                        wire:loading.attr="disabled">{{ $category->name }}</x-button>
                @endforeach
            </div>
            <div class="grid gap-6 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 xs:grid-cols-2 my-10"
                wire:loading.class="opacity-50" wire:target="loadMoreProducts">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full text-center">
                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                            {{ __('No brand products found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
            @if ($products->isEmpty())
                <div class="flex justify-center text-center">
                    <x-button primary type="button" wire:click="loadMoreProducts" wire:loading.attr="disabled">
                        {{ __('Load more products') }}
                    </x-button>
                </div>
            @endif
        </div>
    </section>
</div>
