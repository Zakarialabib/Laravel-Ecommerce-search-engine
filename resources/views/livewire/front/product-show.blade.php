<div>

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}" />
        <meta property="og:title" content="{{ $product->meta_title }}">
        <meta property="og:description" content="{!! $product->meta_description !!}">
        <meta property="og:url" content="{{ URL::current() }}">
        <meta property="og:image" content="{{ asset('images/products/' . $product->image) }}">
        <meta property="og:image:secure_url" content="{{ asset('images/products/' . $product->image) }}">
        <meta property="og:image:width" content="1000">
        <meta property="og:image:height" content="1000">
        <meta property="product:brand" content="{{ $product->brand?->name }}">
        <meta property="product:availability" content="in stock">
        <meta property="product:condition" content="new">
        <meta property="product:price:amount" content="{{ $product->price->price ?? '' }}">
        <meta property="product:price:currency" content="MAD">
    @endsection


    <div class="my-5">
        <div itemtype="https://schema.org/Product" itemscope>

            <meta itemprop="name" content="{{ $product->name }}" />
            <meta itemprop="description" content="{{ $product->description }}" />

            <div class="mx-auto px-4">
                <div class="flex flex-wrap -mx-4 mb-14">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <x-product-carousel :product="$product" />
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <div class="mb-5 pb-5 border-b">
                                <span class="text-gray-500">
                                    {{ $product->category?->name }} /
                                    @isset($product->brand)
                                        <a
                                            href="{{ route('front.brandPage', $product->brand?->slug) }}">{{ $product->brand?->name }}</a>
                                    @endisset
                                    <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
                                        <meta itemprop="brand" content="{{ $product->brand?->name }}" />
                                    </div>
                                </span>
                                <h2 class="mt-2 mb-6 max-w-xl lg:text-5xl sm:text-xl font-bold font-heading">
                                    {{ $product->name }}
                                </h2>

                                <div class="flex items-center">
                                    <div class="flex items-center" itemprop="aggregateRating"
                                        itemtype="https://schema.org/AggregateRating" itemscope>
                                        <meta itemprop="reviewCount" content="{{ $product->reviews->count() }}">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $product->reviews->avg('rating'))
                                                <meta itemprop="ratingValue"
                                                    content="{{ $product->reviews->avg('rating') }}">
                                                <svg class="w-4 h-4 text-orange-500 fill-current"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-orange-500 fill-current"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                                </svg>
                                            @endif
                                        @endfor

                                        <span
                                            class="ml-2 text-sm text-gray-500 font-body">{{ $product->reviews->count() }}
                                            {{ __('Reviews') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div itemprop="offers" itemtype="https://schema.org/AggregateOffer" itemscope>
                                <p class="inline-block mb-4 text-2xl font-bold font-heading">
                                    <span>
                                        {{ Helpers::format_currency( $product->price->price) ?? '' }}
                                    </span>
                                    @if ($product->price->old_price && $product->price->discount != 0)
                                        <span class="bg-red-500 text-white rounded-xl px-4 py-2 text-sm ml-4">
                                            -{{ $product->price->discount }}%
                                        </span>
                                    @endif

                                    <meta itemprop="lowPrice" content="{{ $product->price->old_price ?? '' }}">
                                    <meta itemprop="highPrice" content="{{ $product->price->price ?? '' }}">
                                    <meta itemprop="price" content="{{ $product->price->price ?? '' }}">
                                    <meta itemprop="priceCurrency" content="MAD">
                                    <link itemprop="availability" href="http://schema.org/InStock">
                                    <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                                    <meta itemprop="priceValidUntil" content="2023-12-30">
                                </p>

                                @if ($product->price->old_price && $product->price->discount != 0)
                                    <p class="mb-8 text-blue-300">
                                        <span class="font-normal text-base text-gray-400 line-through">
                                            {{ Helpers::format_currency($product->price->old_price) }}
                                        </span>
                                    </p>
                                @endif
                            </div>

                            <div class="flex mb-5 pb-5 border-b">
                                <div>
                                    @if ($product->status == true)
                                        <a class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-move-400 hover:bg-move-200 transition cursor-pointer"
                                            href="{{ $product->url }}" target="_blank">
                                            {{ __('Boutique') }}
                                        </a>
                                    @else
                                        <div class="text-sm font-bold">
                                            <span class="text-red-500">● {{ __('Not available') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <ul class="my-4 flex gap-4">
                                <li class="text-gray-500 py-1">
                                    <a href="{{ route('front.store-show', $product->url) }}"
                                        class="my-2 inline-flex items-center bg-move-500 hover:bg-indigo-400 text-center text-white font-bold text-xs py-2 px-4 rounded-md uppercase cursor-pointer tracking-wider hover:shadow-lg transition ease-in duration-300 ">
                                        {{ $product->store?->name }} <i class="fas fa-store-alt w-5 h-5 text-white"></i>
                                    </a>
                                </li>
                                <li class="text-gray-500 py-1">
                                    <a href="#"
                                        class="my-2 inline-flex items-center bg-move-500 hover:bg-indigo-400 text-center text-white font-bold text-xs py-2 px-4 rounded-md uppercase cursor-pointer tracking-wider hover:shadow-lg transition ease-in duration-300 ">
                                        {{ $product->store?->location }}
                                        <i class="fa fa-check w-5 h-5 text-white" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>

                            @if ($product->store?->social_links)
                                <div class="flex items-center">
                                    <span
                                        class="mr-8 text-gray-500 font-bold font-heading uppercase">{{ __('SHARE IT') }}</span>
                                    @foreach ($product->store->social_links as $link)
                                        <a class="w-8 h-8 text-blue-500 mr-3" href="{{ $link['url'] }}"
                                            target="__blank">
                                            <i class="{{ $link['icon'] }}"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div x-data="{ activeTab: 'description' }" class="mx-auto px-4 border bg-white shadow-xl">
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'description'"
                                :class="activeTab === 'description' ? 'text-move-400' : ''">
                                {{ __('Description') }}
                            </button>
                        </div>
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'reviews'"
                                :class="activeTab === 'reviews' ? 'text-move-400' : ''">
                                {{ __('Reviews') }}
                            </button>
                        </div>
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'shipping'"
                                :class="activeTab === 'shipping' ? 'text-move-400' : ''">
                                {{ __('Shipping & Returns') }}
                            </button>
                        </div>
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'brands'"
                                :class="activeTab === 'brands' ? 'text-move-400' : ''">
                                {{ __('Product Brand') }}
                            </button>
                        </div>
                    </div>
                    <div x-show="activeTab === 'description'" class="px-5 mb-10">
                        <div role="description" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0">
                            <p class="mb-8 max-w-2xl text-gray-500 font-body">
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                    <div x-show="activeTab === 'reviews'" class="px-5 mb-10">
                        <div role="reviews" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0">
                            {{-- show review or  make review --}}
                            @if (auth()->check())
                                @if ($product->reviews->where('user_id', auth()->user()->id)->count() > 0)
                                    <div class="mb-8">
                                        <h4 class="mb-4 text-2xl font-bold font-heading text-orange-500">
                                            {{ __('Your Review') }}</h4>
                                        <div class="flex items-center">
                                            <input type="hidden" name="rating" id="rating" value="0">
                                            <input type="hidden" name="product_id" id="product_id"
                                                value="{{ $product->id }}">
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="review_id" id="review_id"
                                                value="{{ $product->reviews->where('user_id', auth()->user()->id)->first()->id }}">
                                            <textarea name="review" id="review" cols="30" rows="10"
                                                class="w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">{{ $product->reviews->where('user_id', auth()->user()->id)->first()->review }}</textarea>
                                        </div>
                                        <div class="flex items-center my-4">
                                            <button
                                                class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">{{ __('Send Review') }}</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-8">
                                        <h4 class="mb-4 text-2xl font-bold font-heading text-orange-500">
                                            {{ __('Make Review') }}</h4>
                                        <div class="flex items-center">
                                            <input type="hidden" name="rating" id="rating" value="0">
                                            <input type="hidden" name="product_id" id="product_id"
                                                value="{{ $product->id }}">
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ auth()->user()->id }}">
                                            <textarea name="review" id="review" cols="30" rows="10"
                                                class="w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500"></textarea>
                                        </div>
                                        <div class="flex items-center my-4">
                                            <button
                                                class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">
                                                {{ __('Send Review') }}
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div x-show="activeTab === 'shipping'" class="px-5 mb-10">
                        <div role="shipping" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0">
                            <p class="mb-8 max-w-2xl text-gray-500 font-body">
                                {{-- {!! $product->shipping !!} --}}
                            </p>
                        </div>
                    </div>
                    <div x-show="activeTab === 'brands'" class="px-5 mb-10">
                        <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 -mx-2 px-2">
                            @foreach ($brand_products as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto px-4 mt-5">
                <h4 class="mb-2 text-xl font-bold font-heading">
                    {{ __('Related Products') }}
                </h4>
                <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 -mx-2 px-2">
                    @foreach ($relatedProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
