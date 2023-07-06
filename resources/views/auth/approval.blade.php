@section('title', __('Approval'))
<x-app-layout>
    <div class="bg-move-100 h-screen">
        <div class=" container mx-auto flex flex-col px-5 py-24 justify-center items-center">
            <img class="w-20 h-20" src="{{ asset('images/' . Helpers::settings('site_logo')) }}" loading="lazy"
                alt="{{ Helpers::settings('site_title') }}" />
            <div class="w-full md:w-2/3 flex flex-col mb-16 items-center mt-5 text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-bold text-move-800">{{ __('Waiting Approval') }}
                </h1>
                <p class="mb-8 leading-relaxed text-move-900">
                    {{ __('Your account is not activated, please wait or come back later') }}
                </p>
                <div class="flex flex-row justify-center gap-6 text-sm mt-2 text-move-800 mb-8 w-full">
                    <x-button primary href="/">
                        {{ __('Back Home') }}</x-button>
                    @if (Auth::user()->store && Auth::user()->isVendor())
                        <x-button primary href="{{ route('subscription-confirm') }}">
                            {{ __('confirm subscription') }}</x-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
