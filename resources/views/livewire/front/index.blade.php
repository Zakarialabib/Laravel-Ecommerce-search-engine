<div>
    <div class="relative mx-auto mb-5">

        <div class="w-full mx-auto bg-gray-900">
            @foreach ($this->sliders as $slider)
                <div class="flex flex-wrap -mx-4 py-10 px-4"
                    style="background-image: url({{ asset('images/sliders/' . $slider->image) }});background-size: cover;background-position: center;
                background-blend-mode: overlay;background-color: {{ $slider->bg_color }};">
                    <div class="w-full px-10 lg:mb-5 sm:mb-2">
                        <div class="lg:py-5 py-10 text-white px-5">
                            <h5 class="xl:text-2xl md:text-xl sm:text-md font-bold mb-2 cursor-pointer">
                                {{ $slider->subtitle }}
                            </h5>
                            <h2 class="xl:text-6xl md:text-2xl sm:text-xl font-semibold font-heading cursor-pointer">
                                {{ $slider->title }}
                            </h2>
                            <p class="py-10 xl:text-lg sm:text-sm">
                                {{-- <livewire:front.search-box /> --}}
                                @livewire('front.product-prices')
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($this->subcategories) > 0)
            <div class="w-full py-5 px-4 mx-auto">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-bold text-center mb-4 cursor-pointer">
                        {{ __('Categories') }}
                    </h2>

                    <div class="flex flex-wrap justify-center overflow-x-scroll gap-4 py-4">
                        @foreach ($this->subcategories as $subcategory)
                            <a href="{{ route('front.subcategoryPage', $subcategory->slug) }}"
                                class="relative w-44 h-44" x-data="{ hover: false }" @mouseenter="hover = true"
                                @mouseleave="hover = false">
                                <div
                                    class="absolute top-0 left-0 right-0 bottom-0 rounded bg-white shadow-lg transform hover:scale-105 transition-all duration-300">
                                    <img class="absolute inset-0 w-full h-full object-cover rounded transform-gpu transition-all duration-1000 ease-in-out"
                                        :class="{ 'rotate-0': !hover, 'rotate-360': hover }"
                                        src="{{ $subcategory->image_url }}" alt="{{ $subcategory->name }}">
                                </div>
                                <h2
                                    class="absolute inset-0 flex items-center justify-center text-md text-gray-800 text-center">
                                    {{ $subcategory->name }} {{ __('for') }} {{ $subcategory->category?->name }}
                                </h2>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="w-full mt-20 p-5 mx-auto">
                <h3 class="text-center text-xl">
                    {{ __('Coming soon') }}
                </h3>
            </div>
        @endif

        <div class="mx-auto max-w-[1500px] px-5">
            <div class="grid grid-cols-12 gap-5">
                @foreach ($this->featured_banners as $featured_banner)
                    <div class="col-span-full md:col-span-6">
                        <div
                            class="relative shadow-xl isolate flex aspect-[72/31] sm:aspect-[72/28] lg:aspect-[72/30] xl:aspect-[72/26] w-full items-center overflow-hidden bg-[#953fff]">
                            <div
                                class="flex flex-col gap-y-3 sm:gap-y-4 md:gap-y-5 lg:gap-y-7 xl:gap-y-9 items-start w-2/3 pl-5 sm:pl-7 leading-tight lg:pl-8 lg:pb-3 xl:pl-12 xl:pb-2">
                                <h4
                                    class="text-xl font-bold leading-none tracking-tight text-white sm:text-3xl md:text-2xl md:leading-none lg:text-3xl xl:text-[38px]">
                                    {{ $featured_banner->title }}
                                </h4>
                                <a href="{{ $featured_banner->link }}"
                                    class="inline-flex text-center items-center font-bold leading-none transition-colors justify-center gap-x-3 py-4 px-4 md:py-[17px] lg:px-8 text-sm text-white bg-transparent hover:bg-white hover:text-gray-900 border-2 border-white">Watch
                                    {{ $featured_banner->label }}
                                </a>
                            </div><img
                                class="absolute right-0 top-0 -z-10 block h-full max-w-[50%] lg:max-w-[45%] object-cover object-right"
                                src="{{ asset('images/featuredbanners/' . $featured_banner->image) }}"
                                alt="{{ $featured_banner->title }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mx-auto max-w-[1500px] px-5 py-10 ">
            <div x-data="{ activeTabs: 'brands' }" class="bg-gray-50">
                <div
                    class="bg-white grid gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 border border-move-500 justify-center drop-shadow-sm">
                    @if (count($this->brands) > 0)
                        <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-move-100 hover:border-move-500 focus:outline-none focus:border-move-500 cursor-pointer"
                            @click="activeTabs = 'brands'"
                            :class="{
                                'border-move-500': activeTabs === 'brands',
                                'text-move-500': activeTabs === 'brands',
                                'hover:text-move-500': activeTabs !== 'brands'
                            }">
                            <h4 class="inline-block" :class="{ 'text-move-400': activeTabs === 'brands' }">
                                {{ __('Brands') }}
                            </h4>
                        </div>
                    @endif
                    @if (count($this->featuredProducts) > 0)
                        <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-move-100 hover:border-move-500 focus:outline-none focus:border-move-500 cursor-pointer"
                            @click="activeTabs = 'featuredProducts'"
                            :class="{
                                'border-move-500': activeTabs === 'featuredProducts',
                                'text-move-500': activeTabs === 'featuredProducts',
                                'hover:text-move-500': activeTabs !== 'featuredProducts'
                            }">
                            <h4 class="inline-block" :class="{ 'text-move-400': activeTabs === 'featuredProducts' }">
                                {{ __('Featured Products') }}
                            </h4>
                        </div>
                    @endif
                    @if (count($this->bestOffers) > 0)
                        <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-move-100 hover:border-move-500 focus:outline-none focus:border-move-500 cursor-pointer"
                            @click="activeTabs = 'bestOfers'"
                            :class="{
                                'border-move-500': activeTabs === 'bestOfers',
                                'text-move-500': activeTabs === 'bestOfers',
                                'hover:text-move-500': activeTabs !== 'bestOfers'
                            }">
                            <h4 class="inline-block" :class="{ 'text-move-400': activeTabs === 'bestOfers' }">
                                {{ __('Best Offers') }}
                            </h4>
                        </div>
                    @endif
                    @if (count($this->hotProducts) > 0)
                        <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-move-100 hover:border-move-500 focus:outline-none focus:border-move-500 cursor-pointer"
                            @click="activeTabs = 'hotProducts'"
                            :class="{
                                'border-move-500': activeTabs === 'hotProducts',
                                'text-move-500': activeTabs === 'hotProducts',
                                'hover:text-move-500': activeTabs !== 'hotProducts'
                            }">
                            <h4 class="inline-block" :class="{ 'text-move-400': activeTabs === 'hotProducts' }">
                                {{ __('Hot Products') }}
                            </h4>
                        </div>
                    @endif
                </div>
                <div class="border border-move-500 py-5">
                    @if (count($this->brands) > 0)
                        <div class="px-4" x-show="activeTabs === 'brands'">
                            <div role="brands" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0"
                                class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @foreach ($this->brands as $brand)
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('front.brandPage', $brand->slug) }}">
                                                {{ $brand->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (count($this->featuredProducts) > 0)
                        <div class="px-4" x-show="activeTabs === 'featuredProducts'">
                            <div role="featuredProducts" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0"
                                class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @foreach ($this->featuredProducts as $product)
                                        <x-product-card :product="$product" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (count($this->bestOffers) > 0)
                        <div class="px-4" x-show="activeTabs === 'bestOfers'">
                            <div role="bestOfers" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0"
                                class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @foreach ($this->bestOffers as $product)
                                        <x-product-card :product="$product" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (count($this->hotProducts) > 0)
                        <div class="px-4" x-show="activeTabs === 'hotProducts'">
                            <div role="hotProducts" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0"
                                class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @foreach ($this->hotProducts as $product)
                                        <x-product-card :product="$product" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if (count($this->sections) > 0)
            <div class="py-5 px-4 mx-auto bg-gray-100">
                <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                    @foreach ($this->sections as $section)
                        <div class="px-3 mb-6">
                            <div class="relative h-full text-center pt-16 bg-white">
                                <div class="pb-12 border-b">
                                    <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                    @if ($section->subtitle)
                                        <p>{{ $section->subtitle }}</p>
                                    @endif
                                </div>
                                <div class="py-5 px-4 text-center">
                                    <p class="text-lg text-gray-500">
                                        {!! $section->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
