<div>
    @section('title', __('Services'))

    <section class="bg-gradient-to-b from-white/[55%] to-transparent py-12 dark:from-white/5 md:py-20">
        <div class="px-6">
            <div class="heading text-center">
                <h6 class="text-3xl font-bold sm:!leading-[50px] heading text-center rtl:lg:text-right !text-indigo-600">
                    {{ __('Our service') }}</h6>
                <h4>{{ __('High impact service for your business growth') }}</h4>
            </div>
            <div class="mt-24 grid grid-cols-1 gap-10 space-y-10 text-black ltr:text-right rtl:text-left sm:grid-cols-2 sm:space-y-0 lg:grid-cols-3 aos-init aos-animate"
                data-aos="fade-up" data-aos-duration="1000">
                @foreach ($this->services as $service)
                    <div
                        class="group relative rounded-3xl border-2 border-transparent bg-white p-6 shadow-[-20px_30px_70px_rgba(219,222,225,0.4)] transition duration-500 hover:border-indigo-600 hover:bg-indigo-400/20 dark:border-white/10 dark:bg-transparent dark:bg-gradient-to-b dark:from-white/[0.04] dark:to-transparent dark:!shadow-none dark:hover:bg-indigo-400">
                        <a href="javascript:"
                            class="absolute -top-[50px] flex h-[108px] w-[108px] items-center justify-center rounded-full bg-indigo-400 text-white shadow-[0_15px_30px_rgba(180,118,229,0.4)] group-hover:bg-black group-hover:shadow-[0_15px_30px_rgba(199,55,253,0.4)] ltr:right-4 rtl:left-4">
                            <svg width="52" height="52" viewBox="0 0 52 52" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M46.3017 24.6784V37.6568C46.3017 43.6368 41.4483 48.4901 35.4683 48.4901H16.5317C10.5517 48.4901 5.69833 43.6368 5.69833 37.6568V24.8301C7.345 26.6068 9.685 27.6251 12.22 27.6251C14.95 27.6251 17.5717 26.2601 19.2183 24.0718C20.6917 26.2601 23.205 27.6251 26 27.6251C28.7733 27.6251 31.2433 26.3251 32.7383 24.1584C34.4067 26.3034 36.985 27.6251 39.6717 27.6251C42.2933 27.6251 44.6767 26.5634 46.3017 24.6784Z"
                                    fill="currentcolor"></path>
                                <path
                                    d="M32.4779 2.70801H19.4779L17.8746 18.6547C17.7446 20.128 17.9613 21.5147 18.5029 22.7713C19.7596 25.718 22.7063 27.6247 25.9996 27.6247C29.3363 27.6247 32.2179 25.7613 33.5179 22.793C33.9079 21.8613 34.1463 20.778 34.1679 19.673V19.2613L32.4779 2.70801Z"
                                    fill="currentcolor"></path>
                                <path opacity="0.6"
                                    d="M48.4467 17.9185L47.8183 11.9168C46.9083 5.3735 43.94 2.7085 37.5917 2.7085H29.2717L30.875 18.9585C30.8967 19.1752 30.9183 19.4135 30.9183 19.8252C31.0483 20.9518 31.395 21.9918 31.915 22.9235C33.475 25.7835 36.5083 27.6252 39.6717 27.6252C42.5533 27.6252 45.1533 26.3468 46.7783 24.0935C48.0783 22.3602 48.6633 20.1718 48.4467 17.9185Z"
                                    fill="currentcolor"></path>
                                <path opacity="0.6"
                                    d="M14.2783 2.7085C7.90834 2.7085 4.96167 5.3735 4.03 11.9818L3.445 17.9402C3.22834 20.2585 3.85667 22.5118 5.22167 24.2668C6.86834 26.4118 9.40334 27.6252 12.22 27.6252C15.3833 27.6252 18.4167 25.7835 19.955 22.9668C20.5183 21.9918 20.8867 20.8652 20.995 19.6952L22.685 2.73016H14.2783V2.7085Z"
                                    fill="currentcolor"></path>
                                <path
                                    d="M24.5917 36.0969C21.84 36.3785 19.76 38.7185 19.76 41.4919V48.4902H32.2183V42.2502C32.24 37.7219 29.575 35.5769 24.5917 36.0969Z"
                                    fill="currentcolor"></path>
                            </svg>
                        </a>
                        <h3 class="mt-[86px] text-[22px] font-extrabold dark:text-white dark:group-hover:text-black">
                            {{ $service->title }}
                        </h3>
                        <p class="text=lg mt-4 font-semibold text-gray dark:group-hover:text-black">
                            {!! $service->content !!}
                        </p>
                        <a href="services-detail.html"
                            class="mt-6 flex h-11 w-11 items-center justify-center rounded-full bg-[#F3F4F6] transition group-hover:bg-black group-hover:text-white ltr:float-right rtl:float-left dark:bg-gray-dark">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="text-black transition group-hover:text-white rtl:rotate-180 dark:text-white">
                                <path
                                    d="M9.41083 14.4109L10.5892 15.5892L16.1783 10.0001L10.5892 4.41089L9.41083 5.58922L12.9883 9.16672H5V10.8334H12.9883L9.41083 14.4109Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section
        class="bg-gradient-to-t from-transparent to-white/[55%] py-12 dark:bg-gradient-to-b dark:from-white/5 dark:to-transparent lg:py-24">
        <div class="px-6">
            <div class="heading mb-0 text-center">
                <h6>{{ __('Pricing Plan') }}</h6>
                <h4>{{ __('Choose Affordable Prices') }}</h4>
            </div>
            <div class="mt-14 grid grid-cols-1 justify-between gap-10 sm:grid-cols-2 md:mt-20 lg:grid-cols-3 lg:gap-7 aos-init aos-animate"
                data-aos="fade-up" data-aos-duration="1000">
                @foreach ($this->subscriptions as $subscription)
                    <div
                        class="flex flex-col pt-8 pb-8 h-full rounded-md shadow-md group relative space-y-6 border-2 border-indigo-600 bg-gray-50 hover:bg-indigo-600 hover:text-black dark:border-gray/[0.1] dark:bg-gray-dark dark:hover:border-indigo-700 hover:scale-105 transition duration-500 ">
                        <div
                            class="item-center absolute -top-[30px] left-1/2 mx-auto inline-flex -translate-x-1/2 justify-between rounded-[78px] bg-indigo-700 py-4 px-8 text-white">
                            <h5 class="text-[22px] font-black">{{ $subscription->name }}
                            </h5>
                        </div>

                        <div class="mt-5 text-center">
                            <span
                                class="text-6xl md:text-7xl text-coolGray-900 font-semibold tracking-tighter">{{ Helpers::format_currency($subscription->price) }}</span>
                            <span
                                class="inline-block ml-1 text-coolGray-500 font-semibold">/{{ $subscription->plan }}</span>
                        </div>

                        <div class="my-7 h-[2px] bg-gray/10"></div>

                        <ul class="flex items-center gap-2 self-start px-8">
                            @foreach ($subscription->features as $index => $feature)
                                <li class="flex items-center mb-4 text-coolGray-500 font-medium">
                                    <svg class="mr-3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8" cy="8" r="8" fill="#45B649"></circle>
                                        <path d="M5.11438 8.11438L7 10L10.7712 6.22876" stroke="white"
                                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-sm font-bold">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="pt-24 bg-white">
        <div class="relative -mb-40 py-16 px-4 md:px-8 lg:px-16 bg-coolGray-800 rounded-md overflow-hidden">
            <img class="absolute top-0 left-0 h-full w-full object-cover"
                src="{{ asset('images/svg/pattern-dark.svg') }}" alt="">
            <div class="relative max-w-max mx-auto text-center">
                <h3 class="mb-2 text-2xl md:text-5xl leading-tight font-bold text-white tracking-tighter">
                    {{ __('Have any additional questions?') }}</h3>
                <p class="mb-6 text-base md:text-xl text-coolGray-400">
                    {{ __('CHRILIA is the best solution to market your products') }}
                </p>
                <a class="inline-flex items-center justify-center px-7 py-3 h-14 w-full md:w-auto mb-2 md:mb-0 md:mr-4 text-lg leading-7 text-green-50 bg-green-500 hover:bg-green-600 font-medium focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 border border-transparent rounded-md shadow-sm"
                    href="#">
                    {{ __('Get in touch') }}
                </a>
            </div>
        </div>
        <div class="h-64 bg-green-500"></div>
    </section>
</div>
