<section class="py-5 px-6 bg-white shadow">
    <nav class="md:flex gap-x-7 xl:gap-x-10 text-sm font-bold">
        <a href="{{ route('vendor.dashboard') }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase">
            {{ __('Dashboard') }}
        </a>

        <a href="{{ route('vendor.products') }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase">
            {{ __('List of products') }}
        </a>

        <a href="{{ route('vendor.settings') }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase">
            {{ __('Settings') }}
        </a>

        <a href="{{ route('vendor.account') }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase">
            {{ __('Configuration') }}
        </a>

        <a href="{{ route('vendor.subscription') }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase">
            {{ __('Subscription') }}
        </a>
        @php
            $store = \App\Models\Store::with('user')
                ->where('user_id', Auth::user()->id)
                ->first();
        @endphp
        <a href="{{ route('front.store-show', $store->slug) }}"
            class="relative inline-flex items-center hover:text-redBrick-400 gap-x-2 leading-10 after:absolute after:bottom-[10px] after:left-0 after:bg-white after:transition-transform after:w-full after:origin-left after:scale-x-100 uppercase"
            target="__blank">
            {{ __('Store') }}
        </a>
    </nav>
</section>
