<div x-data="{ isMenuOpen: false }"
    class="px-6 py-2 bg-gradient-to-l from-move-400 via-move-600 to-move-800 text-white relative shadow-lg" x-cloak>
    <div class="hidden md:flex ">
        <button type="button"
            class="lg:text-md md:text-sm text-center uppercase font-semibold font-heading text-white"
            x-on:click="isMenuOpen = !isMenuOpen" @mouseenter="isMenuOpen = true" @click.away="isMenuOpen = false">
            <svg width="28" height="20" viewbox="0 0 20 12" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1 2H19C19.2652 2 19.5196 1.89464 19.7071 1.70711C19.8946 1.51957 20 1.26522 20 1C20 0.734784 19.8946 0.48043 19.7071 0.292893C19.5196 0.105357 19.2652 0 19 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1C0 1.26522 0.105357 1.51957 0.292893 1.70711C0.48043 1.89464 0.734784 2 1 2ZM19 10H1C0.734784 10 0.48043 10.1054 0.292893 10.2929C0.105357 10.4804 0 10.7348 0 11C0 11.2652 0.105357 11.5196 0.292893 11.7071C0.48043 11.8946 0.734784 12 1 12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10ZM19 5H1C0.734784 5 0.48043 5.10536 0.292893 5.29289C0.105357 5.48043 0 5.73478 0 6C0 6.26522 0.105357 6.51957 0.292893 6.70711C0.48043 6.89464 0.734784 7 1 7H19C19.2652 7 19.5196 6.89464 19.7071 6.70711C19.8946 6.51957 20 6.26522 20 6C20 5.73478 19.8946 5.48043 19.7071 5.29289C19.5196 5.10536 19.2652 5 19 5Z"
                    fill="#8594A5"></path>
            </svg>
        </button>

        <div class="w-full flex items-center justify-center space-x-4">
            @foreach (\App\Helpers::getActiveCategories() as $category)
                <a href="{{ route('front.categories') }}?c={{ $category->id }}"
                    class="relative inline-flex items-center py-2 text-md font-medium lg:text-15px text-brand-dark group-hover:text-brand before:absolute before:w-0 before:right-0 rtl:left-0 before:bg-brand before:h-[3px] before:transition-all before:duration-300 before:-bottom-[14px] group-hover:before:w-full group-hover:before:left-0 rtl:group-hover:before:right-0 lrt:group-hover:before:right-auto rtl:group-hover:before:left-auto text-white hover:text-move-400 hover:underline transition hover:scale-110">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
    <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300 transform origin-top"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 opacity-0 transform origin-top"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="-translate-y-4 scale-95"
        class="absolute z-10 top-full max-w-screen-xl w-64 bg-white
             grid grid-cols-1 py-2 text-center rounded-md shadow-lg
             overflow-y-auto scrollbar__inverted h-auto"
        @mouseenter="isMenuOpen = true" @click.away="isMenuOpen = false">
        <ul class="py-2 text-sm text-brand-muted">
            @foreach (\App\Helpers::getActiveBrands() as $brand)
                <li class="relative">
                    <a href="{{ route('front.brandPage', $brand->slug) }}"
                        class="flex items-center justify-between py-2 pl-5 rtl:pr-5 xl:pl-7 xl:rtl:pr-7 pr-3 rtl:pl-3 xl:pr-3.5 xl:rtl:pl-3.5 hover:bg-indigo-200 text-black hover:text-indigo-500 transition hover:scale-y-110 uppercase">
                        {{ $brand->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="md:hidden">
        @livewire('front.search-box')
    </div>
</div>
