<div>
    <div class="container px-4 mx-auto">
        <div class="relative px-10 py-12 xl:py-16 xl:px-20 mb-8 sm:mb-14 bg-indigo-600 overflow-hidden rounded-3xl">
            <img class="absolute right-0 sm:right-12 md:right-24 top-1/2 transform -translate-y-1/2 scale-150 md:scale-100"
                src="" alt="">
            <div class="relative z-10">
                <h2 class="mb-5 text-5xl md:text-7xl text-white font-heading font-semibold">
                    {{ __('Welcome to Chrilia Dashboard') }}
                </h2>
                <p class="text-white max-w-xs font-medium">{{ __('You could track visits & manage listings with ease') }}
                </p>
            </div>
        </div>
        <div class="px-10">
            <div class="flex flex-wrap justify-between items-center pl-9">
                <div class="w-full md:w-auto mb-10 md:mb-0">
                    <div class="flex flex-wrap items-start mb-2">
                        <h3 class="w-full md:w-auto text-3xl font-heading font-medium leading-10">
                            {{ __('Store Connection') }}</h3>
                    </div>
                    <p class="text-darkBlueGray-400 font-heading">{{ __('Connect Your Store') }}</p>
                </div>
                <div class="w-full max-w-max pr-9"><button
                        class="block py-4 px-7 w-full leading-3 text-white font-semibold tracking-tighter font-heading text-center bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-xl"
                        wire:click="$emit('loginModal')" type="button">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 py-4" x-data="{
                showSheet: true,
                showShopify: false,
                showWordpress: false,
                showYoucan: false,
                showApi: false,
            }">
                <div
                    class="flex flex-col items-center space-y-6 pl-9 py-10 px-5 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">

                    <button @click="showSheet = !showSheet"
                        class="flex items-center justify-between w-full p-4 pb-1 text-left select-none">
                        <h2>{{ __('Google Sheet Feed') }}</h2>
                        <svg class="w-5 h-5 duration-300 ease-out" :class="{ '-rotate-[45deg]': activeAccordion == id }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </button>
                    <div x-show="showSheet" x-collapse x-cloak>
                        <div class="p-4 pt-2 opacity-70">
                            <p>Here's how to use it:</p>
                            <ul>
                                <li>Step 1: Click on the link of google sheet feed.</li>
                                <li>Step 2: Download or Copy the file & Fill your product informations.</li>
                                <li>Step 3: Make the file accessible, & share the link with us.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center space-y-6 pl-9 py-10 px-5 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">

                    <button @click="showShopify = !showShopify"
                        class="flex items-center justify-between w-full p-4 pb-1 text-left select-none">
                        <h2>Shopify</h2>
                        <svg class="w-5 h-5 duration-300 ease-out" :class="{ '-rotate-[45deg]': activeAccordion == id }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </button>
                    <div x-show="showShopify" x-collapse x-cloak>
                        <div class="p-4 pt-2 opacity-70">
                            <p>{{ __('Connect your Shopify store by providing your API key and secret') }}.</p>
                            <p>{{ __("Here's how to connect your Shopify store") }}:</p>
                            <ul>
                                <li>Step 1: Login to your Shopify store and create a new private app.</li>
                                <li>Step 2: Copy the API key and secret.</li>
                                <li>Step 3: Paste the API key and secret into the fields below.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center space-y-6 pl-9 py-10 px-5 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">


                    <button @click="showYoucan = !showYoucan"
                        class="flex items-center justify-between w-full p-4 pb-1 text-left select-none">
                        <h2>YouCan</h2>
                        <svg class="w-5 h-5 duration-300 ease-out" :class="{ '-rotate-[45deg]': activeAccordion == id }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </button>

                    <div x-show="showYoucan" x-collapse x-cloak>
                        <div class="p-4 pt-2 opacity-70">
                            <p>{{ __('Connect your YouCan store by providing your API key and secret') }}.</p>
                            <p>{{ __("Here's how to connect your Youcan store") }}:</p>
                            <ul>
                                <li>Step 1: Login to your Shopify store and create a new private app.</li>
                                <li>Step 2: Copy the API key and secret.</li>
                                <li>Step 3: Paste the API key and secret into the fields below.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center space-y-6 pl-9 py-10 px-5 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <button @click="showApi = !showApi"
                        class="flex items-center justify-between w-full p-4 pb-1 text-left select-none">
                        <h2>API</h2>
                        <svg class="w-5 h-5 duration-300 ease-out" :class="{ '-rotate-[45deg]': activeAccordion == id }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </button>

                    <div x-show="showApi" x-collapse x-cloak>
                        <div class="p-4 pt-2 opacity-70">
                            <p>{{ __('Connect to our API by generating a unique API key') }}.</p>
                            <p>{{ __("Here's how to connect your API store") }}:</p>
                            <ul>
                                <li>Step 1: Login to your Shopify store and create a new private app.</li>
                                <li>Step 2: Copy the API key and secret.</li>
                                <li>Step 3: Paste the API key and secret into the fields below.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center space-y-6 pl-9 py-10 px-5 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <button @click="showWordpress = !showWordpress"
                        class="flex items-center justify-between w-full p-4 pb-1 text-left select-none">
                        <h2>WordPress</h2>
                        <svg class="w-5 h-5 duration-300 ease-out" :class="{ '-rotate-[45deg]': activeAccordion == id }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </button>
                    <div x-show="showWordpress" x-collapse x-cloak>
                        <div class="p-4 pt-2 opacity-70">
                            <p>{{ __('Connect your WordPress site by installing our plugin') }}</p>
                            <p>{{ __("Here's how to connect your Wordpress") }}:</p>
                            <ul>
                                <li>Step 1: download our plugin.</li>
                                <li>Step 2: Authentificate with our platform .</li>
                                <li>Step 3: Check the connection if's working.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @livewire('vendor.login') --}}
    </div>
</div>
