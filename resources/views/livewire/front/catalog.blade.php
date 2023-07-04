<div>
    <div class="w-full px-4 mx-auto">
        <div class="mb-10 items-center justify-between bg-white py-4">
            <div class="w-full md:px-4 sm:px-2 flex flex-wrap justify-between">
                <ul class="flex flex-wrap items-center mb-10 xl:mb-0">
                    <li class="mr-6">
                        <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500" href="/">
                            <span>Home</span>
                            <svg class="ml-6" width="4" height="7" viewBox="0 0 4 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.150291 0.898704C-0.0500975 0.692525 -0.0500975 0.359292 0.150291 0.154634C0.35068 -0.0507836 0.674443 -0.0523053 0.874831 0.154634L3.7386 3.12787C3.93899 3.33329 3.93899 3.66576 3.7386 3.8727L0.874832 6.84594C0.675191 7.05135 0.35068 7.05135 0.150292 6.84594C-0.0500972 6.63976 -0.0500972 6.30652 0.150292 6.10187L2.49888 3.49914L0.150291 0.898704Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="mr-6">
                        <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500"
                            href="{{ URL::current() }}">
                            <span>{{ __('Catalog') }}</span>
                            <svg class="ml-6" width="4" height="7" viewBox="0 0 4 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.150291 0.898704C-0.0500975 0.692525 -0.0500975 0.359292 0.150291 0.154634C0.35068 -0.0507836 0.674443 -0.0523053 0.874831 0.154634L3.7386 3.12787C3.93899 3.33329 3.93899 3.66576 3.7386 3.8727L0.874832 6.84594C0.675191 7.05135 0.35068 7.05135 0.150292 6.84594C-0.0500972 6.63976 -0.0500972 6.30652 0.150292 6.10187L2.49888 3.49914L0.150291 0.898704Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <li><a class="text-sm font-medium text-indigo-500 hover:text-indigo-600" href="#">Catalog</a>
                    </li>
                </ul>

                <div class="pb-9 text-center border-b border-black border-opacity-5">
                    <div class="relative">
                        <h2
                            class="mb-5 md:mb-0 text-9xl xl:text-10xl leading-normal font-heading font-medium text-center">
                            New in</h2>
                        <span
                            class="md:absolute md:right-0 md:bottom-3 text-sm text-gray-400 font-medium">{{ $products->count() }}
                            {{ __('Products') }}</span>
                    </div>
                </div>


                <div class="flex flex-wrap py-5 mb-14 xl:mb-16 border-b border-black border-opacity-10">
                    <div class="w-full sm:w-1/3 lg:w-1/5 py-2 sm:px-3">
                        <select
                            class="px-5 py-3 mr-2 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                            id="sortBy" wire:model="sorting">
                            <option disabled>{{ __('Choose filters') }}</option>
                            @foreach ($sortingOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-1/3 lg:w-1/5 py-2 sm:px-3">
                        <select
                            class="px-5 py-3 mr-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                            id="perPage" wire:model="perPage">
                            <option value="20" selected>20 {{ __('Items') }}</option>
                            <option value="50">50 {{ __('Items') }}</option>
                            <option value="100">100 {{ __('Items') }}</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-1/3 lg:w-1/5 py-2 sm:px-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
            <div class="flex items-center justify-center -mt-2 pb-0.5 mb-4 md:mb-5 lg:mb-6 2xl:mb-7 3xl:mb-8">
                <h3 class="text-lg pt-5 md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                    {{ __('Shop By Category') }}
                </h3>
            </div>
            <div x-data="{ swiper: null }" x-init="swiper = new Swiper($refs.container, {
                loop: true,
                slidesPerView: 'auto',
                spaceBetween: 0,
                grabCursor: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            })" class="relative w-10/12 mx-auto flex flex-row">
                <div class="absolute inset-y-0 left-0 z-10 flex items-center">
                    <button @click="swiper.slidePrev()"
                        class="bg-white -ml-2 lg:-ml-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-left w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="swiper-container" x-ref="container">
                    <div class="swiper-wrapper">
                        @foreach (\App\Helpers::getActiveCategories() as $category)
                            <div class="swiper-slide w-auto px-4">
                                <div class="relative inline-flex mb-3.5 md:mb-4 lg:mb-5 xl:mb-6 mx-auto rounded-full">
                                    <button type="button" wire:click="filterProducts('category', {{ $category->id }})">
                                        <div class="flex">
                                            <span
                                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                                <span
                                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                                    <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;"
                                                        alt="" aria-hidden="true"
                                                        src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27180%27%20height=%27180%27/%3e"></span><img
                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                    decoding="async" data-nimg="intrinsic"
                                                    class="object-cover bg-gray-300 rounded-full"
                                                    style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"><noscript></noscript></span>
                                        </div>
                                        <div
                                            class="absolute top left bg-black w-full h-full opacity-0 transition-opacity duration-300 group-hover:opacity-30 rounded-full">
                                        </div>
                                        <div class="absolute top left h-full w-full flex items-center justify-center">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 512 512"
                                                class="text-white text-base sm:text-xl lg:text-2xl xl:text-3xl transform opacity-0 scale-0 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-100"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h4
                                            class="text-heading text-sm md:text-base xl:text-lg font-semibold capitalize">
                                            {{ $category->name }}
                                        </h4>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 z-10 flex items-center">
                    <button @click="swiper.slideNext()"
                        class="bg-white -mr-2 lg:-mr-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-right w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach ($this->categories as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterProducts('category', {{ $category->id }})">
                                    <span class="block py-5 px-10 mb-3 bg-white font-heading font-medium rounded-3xl">
                                        {{ $category->name }} <small>
                                            ({{ $category->products->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($category_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('category')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openSubcategory: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Subcategory') }}</h3>
                        <button @click="openSubcategory = !openSubcategory">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul x-show="openSubcategory">
                        @foreach ($this->subcategories as $subcategory)
                            <li class="mb-2">
                                <button type="button"
                                    wire:click="filterProducts('subcategory', {{ $subcategory->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $subcategory->name }} <small>
                                            ({{ $subcategory->products->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($subcategory_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('subcategory')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>

                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Price budget') }}</h3>
                    <div>
                        <div class="flex justify-between">
                            <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                <p class="">{{ __('Min Price') }}</p>
                                <x-input type="text" wire:model="minPrice" placeholder="350" />
                            </span>
                            <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                <p class="">{{ __('Max Price') }}</p>
                                <x-input type="text" wire:model="maxPrice" placeholder="1000" />
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openbrands: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Brands') }}</h3>
                        <button @click="openbrands = !openbrands">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul x-show="openbrands" class="flex flex-wrap items-center">
                        @foreach ($this->brands as $brand)
                            <li class="mx-2 mb-2">
                                <button type="button" wire:click="filterProducts('brand', {{ $brand->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $brand->name }} <small> ({{ $brand->products->count() }})</small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($brand_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('brand')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>
                <div class="mb-10 xl:mb-11">
                    <h2 class="mb-6 text-3xl leading-9 font-heading font-medium">Location</h2>
                    <a class="flex items-center py-4 px-10 mb-3 leading-8 font-heading font-medium bg-white rounded-3xl" href="#">
                      <span class="mr-6">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect width="27" height="27" rx="8" fill="#28E172"></rect>
                          <path d="M11.4534 19L6 13.6758L6.72022 12.9726L11.4534 17.5937L21.2798 8L22 8.70316L11.4534 19Z" fill="white"></path>
                        </svg>
                      </span>
                      <span>Europe</span>
                    </a>
                    <a class="flex items-center py-4 px-10 leading-8 font-heading font-medium bg-white bg-opacity-50 rounded-3xl" href="#">
                      <span class="mr-6">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.5" y="0.5" width="26" height="26" rx="5.5" fill="white" stroke="#DBDDE1"></rect></svg>
                      </span>
                      <span>United States</span>
                    </a>
                  </div>
            </div>
            <div class="w-full lg:w-3/4 px-4" wire:loading.class.delay="opacity-50">
                <div itemscope itemtype="https://schema.org/ItemList">
                    <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 xs:grid-cols-2 mb-10">
                        @forelse ($products as $product)
                            <x-product-card :product="$product" />
                        @empty
                            <div class="w-full">
                                <h3 class="text-3xl font-bold font-heading text-blue-900">
                                    {{ __('No products found') }}
                                </h3>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
