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
                            {{ __('Watches') }}</span>
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
