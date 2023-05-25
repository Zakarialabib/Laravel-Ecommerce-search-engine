@extends('layouts.dashboard')
@section('title', __('Susbcription'))
@section('content')
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Select a Subscription') }}
                </h6>
            </div>
        </div>

        <div class="mt-4">

            <div class="md:grid md:grid-cols-2 md:gap-x-16 gap-8 max-w-6xl mx-auto">
                @foreach ($subscriptions as $subscription)
                    <div class="p-8 md:p-14 mb-8 md:mb-0 shadow-2xl rounded-5xl bg-white">
                        <img class="mb-9 w-10 h-10" src="uinel-assets/elements/pricing/circle10-small.svg" alt="">
                        <div class="flex flex-wrap items-center justify-between -mb-4">
                            <h3 class="mb-4 font-heading text-7xl leading-10 tracking-tight">{{ $subscription->name }}</h3>
                            <div class="mb-4 font-heading pl-4 text-3xl flex items-center leading-5 tracking-tighter">
                                <span class="text-base mr-2 -mb-1">$</span>
                                <span>{{ $subscription->price }}</span>
                            </div>
                        </div>
                        <p class="font-normal font-heading text-base leading-loose text-darkBlueGray-400 mt-6 mb-10">
                            {{ $subscription->descrption }}
                        </p>
                        <button type="button"
                            class="block py-3 px-10 md:mr-auto w-full md:max-w-max text-xl leading-7 text-white font-medium tracking-tighter font-heading text-center bg-purple-500 hover:bg-purple-600 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 rounded-xl"
                            wire:click="selectSubscription({{ $subscription->id }})">Select</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="p-4">
            <div class="pt-3">
                <table class="w-full rounded-t-lg m-5 mx-auto bg-gray-800 text-gray-200">
                    <thead>
                        <tr class="text-left border-b border-gray-300">
                            <th class="px-4 py-3">
                                {{ __('Subscription name') }}
                            </th>
                            <th class="px-4 py-3">
                                {{ __('Subscription details') }}
                            </th>
                            <th class="px-4 py-3">
                                {{ __('Price') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptions as $subscription)
                            <tr class="bg-gray-700 border-b border-gray-600">
                                <td class="px-4 py-3">
                                    {{ $subscription->name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $subscription->details }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $subscription->pivot->price }} {{ config('settings.currency_symbol') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>{{ __('No entries found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
