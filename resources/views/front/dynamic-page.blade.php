@section('title', $page->title)
<x-app-layout>
    <section>
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8">
            <img src="{{ asset('images/page' . $page->image) }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-white md:text-5xl">
                {{ $page->title }}
            </h1>
            <p class="py-10">{!! $page->description !!}</p>
        </article>
    </section>
    <section class="font-medium bg-blueGray-100 rounded-b-10xl py-24 2xl:pt-52 2xl:pb-40">
        <div class="container px-4 mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 justify-center gap-16 xl:gap-40">
                <div class="max-w-sm mx-auto px-10 py-6 text-center rounded-3xl bg-orange-500 text-white">
                    <h3 class="mb-10 font-heading text-5xl leading-loose">{{ __('Inside Information') }}</h3>
                    <p class="font-normal leading-loose text-darkBlueGray-400">
                        {{ __('Experts in consumer electronics, software, and hardware , we try gather all information in one place') }}
                    </p>
                </div>
                <div class="max-w-sm mx-auto px-10 py-6 text-center rounded-3xl bg-orange-500 text-white">
                    <h3 class="mb-10 font-heading text-5xl leading-loose">{{ __('5000+ devices') }}</h3>
                    <p class="font-normal leading-loose text-darkBlueGray-400">
                        {{ __('We have more than 5000 devices in our database and we are adding more every day') }}
                    </p>
                </div>
                <div class="max-w-sm mx-auto px-10 py-6 text-center rounded-3xl bg-orange-500 text-white">
                    <h3 class="mb-10 font-heading text-5xl leading-loose">
                        {{ __('Compare & Search') }}
                    </h3>
                    <p class="font-normal leading-loose text-darkBlueGray-400">
                        {{ __("we don't sell anything, we just help you to find the best product for you") }}
                    </p>
                </div>
                <div class="max-w-sm mx-auto px-10 py-6 text-center rounded-3xl bg-orange-500 text-white">
                    <h3 class="mb-10 font-heading text-5xl leading-loose">
                        {{ __('Price History') }}
                    </h3>
                    <p class="font-normal leading-loose text-darkBlueGray-400">
                        {{ __('We track the price of the products and show you the history of the price') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
