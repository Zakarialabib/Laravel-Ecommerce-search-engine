<div>
    <div class="container px-4 mx-auto">
        <div class="relative px-10 py-12 xl:py-16 xl:px-20 mb-8 sm:mb-14 bg-indigo-600 overflow-hidden rounded-3xl">
            <img class="absolute right-0 sm:right-12 md:right-24 top-1/2 transform -translate-y-1/2 scale-150 md:scale-100"
                src="uinel-assets/images/dashboard-content/header.png" alt="">
            <div class="relative z-10">
                <h2 class="mb-5 text-5xl md:text-7xl text-white font-heading font-semibold">Are u looging for answers?
                </h2>
                <p class="text-white max-w-xs font-medium">We have prepared the most frequently asked questions for you.
                </p>
            </div>
        </div>
        <div class="px-10">
            <div class="flex flex-wrap justify-between items-center pl-9">
                <div class="w-full md:w-auto mb-10 md:mb-0">
                    <div class="flex flex-wrap items-start mb-2">
                        <h3 class="w-full md:w-auto text-3xl font-heading font-medium leading-10">
                            {{ __('Store Connection') }}</h3>
                        <div
                            class="order-first md:order-last mb-2 md:mb-0 px-2 md:ml-2 text-center bg-green-200 bg-opacity-70 rounded-full">
                            <span class="text-xxs align-middle font-bold text-green-500 leading-7">16 NEW</span>
                        </div>
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
            <div class="grid grid-cols-2 gap-4" x-data="{
                showSheet: true,
                showShopify: false,
                showWordpress: false,
                showYoucan: false,
                showApi: false,
            }">
                <div
                    class="flex items-center pl-9 p-5 mt-14 h-20 bg-blueGray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <h2>{{ __('Google Sheet Feed') }}</h2>
                    <p>{{ __('Fill Google Sheet file & share it with us') }}.</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="showSheet = !showSheet">
                        more info
                    </button>
                    <div x-show="showSheet" class="py-5">
                        <p>Here's how to use it:</p>
                        <ul>
                            <li>Step 1: Click on the link of google sheet feed.</li>
                            <li>Step 2: Download or Copy the file & Fill your product informations.</li>
                            <li>Step 3: Make the file accessible, & share the link with us.</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="flex items-center pl-9 p-5 mt-14 h-20 bg-gray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <h2>Shopify</h2>
                    <p>{{ __('Connect your Shopify store by providing your API key and secret') }}.</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="showShopify = !showShopify">
                        more infos
                    </button>
                    <div x-show="showShopify" class="py-5">
                        <p>{{ __("Here's how to connect your Shopify store") }}:</p>
                        <ul>
                            <li>Step 1: Login to your Shopify store and create a new private app.</li>
                            <li>Step 2: Copy the API key and secret.</li>
                            <li>Step 3: Paste the API key and secret into the fields below.</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="flex items-center pl-9 p-5 mt-14 h-20 bg-gray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <h2>YouCan</h2>
                    <p>{{ __('Connect your YouCan store by providing your API key and secret') }}.</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="showYoucan = !showYoucan">
                        more infos
                    </button>

                    <div x-show="showYoucan" class="py-5">
                        <p>{{ __("Here's how to connect your Youcan store") }}:</p>
                        <ul>
                            <li>Step 1: Login to your Shopify store and create a new private app.</li>
                            <li>Step 2: Copy the API key and secret.</li>
                            <li>Step 3: Paste the API key and secret into the fields below.</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="flex items-center pl-9 p-5 mt-14 h-20 bg-gray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <h2>API</h2>
                    <p>{{ __('Connect to our API by generating a unique API key') }}.</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="showApi = !showApi">
                        more infos
                    </button>
                    <div x-show="showApi" class="py-5">
                        <p>{{ __("Here's how to connect your API store") }}:</p>
                        <ul>
                            <li>Step 1: Login to your Shopify store and create a new private app.</li>
                            <li>Step 2: Copy the API key and secret.</li>
                            <li>Step 3: Paste the API key and secret into the fields below.</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="flex items-center pl-9 p-5 mt-14 h-20 bg-gray-50 min-w-max border-l border-t border-b border-gray-100 rounded-tl-5xl rounded-bl-5xl">
                    <h2>WordPress</h2>
                    <p>{{ __('Connect your WordPress site by installing our plugin') }}</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="showWordpress = !showWordpress">
                        more infos
                    </button>
                    <div x-show="showWordpress" class="py-5">
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
        {{-- @livewire('vendor.login') --}}
    </div>
</div>
