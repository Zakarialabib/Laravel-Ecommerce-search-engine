<div>
    <a class="inline-block mb-14 text-3xl font-bold font-heading" href="#">
        <img class="h-9" src="#" alt="" width="auto">
    </a>

    <div class="w-full lg:w-1/2 py-10 px-5 my-auto" x-data="{ isTab: 'login' }">
        <div class="flex mb-6">
            <button type="button"
                class="w-1/2 py-2 px-6 text-center bg-gray-100 text-black hover:bg-blue-600 hover:text-white rounded shadow-md"
                :class="{ 'bg-blue-600 text-white': isTab === 'login' }" @click="isTab = 'login'">
                {{ __('Login') }}
            </button>
            <button type="button"
                class="w-1/2 py-2 px-6 text-center bg-gray-100 text-black hover:bg-blue-600 hover:text-white rounded shadow-md"
                :class="{ 'bg-blue-600 text-white': isTab === 'register' }" @click="isTab = 'register'">
                {{ __('Register') }}
            </button>
        </div>
        <div class="space-y-4 mb-6">
            @if ($isStoreOwner)
                <a class="inline-flex items-center mb-2 px-6 py-3 bg-white rounded-xl"
                    href="{{ route('login.facebook') }}">
                    <span class="mr-6">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="18" fill="#A692FF"></circle>
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M15.135 24.3373L9 18.2023L9.81024 17.392L15.135 22.7168L26.1898 11.6621L27 12.4724L15.135 24.3373Z"
                                    fill="white"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="18" height="18" fill="white" transform="translate(9 9)">
                                    </rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <p>{{ __('Login with Facebook') }}</p>
                </a>
                <a class="inline-flex items-center mb-2 px-6 py-3 bg-white rounded-xl"
                    href="{{ route('login.google') }}">
                    <span class="mr-6">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="18" fill="#A692FF"></circle>
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M15.135 24.3373L9 18.2023L9.81024 17.392L15.135 22.7168L26.1898 11.6621L27 12.4724L15.135 24.3373Z"
                                    fill="white"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="18" height="18" fill="white" transform="translate(9 9)">
                                    </rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <p>{{ __('Login with Google') }}</p>
                </a>
            @endif
        </div>
        <div x-show="isTab === 'login'">
            <h1 class="mb-8 text-4xl md:text-5xl font-bold font-heading">
                {{ __('Login to your account') }}
            </h1>
            @livewire('auth.login')
        </div>
        <div x-show="isTab === 'register'">
            <h1 class="mb-8 text-4xl md:text-5xl font-bold font-heading">
                {{ __('Register as') }}
            </h1>
            @livewire('auth.register')
        </div>
    </div>

    <div class="lg:w-1/2 sm:w-full relative pb-full md:flex md:pb-0">
        <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);"
            class="absolute pin bg-no-repeat md:bg-left w-full h-full bg-center bg-cover"></div>
    </div>
</div>
