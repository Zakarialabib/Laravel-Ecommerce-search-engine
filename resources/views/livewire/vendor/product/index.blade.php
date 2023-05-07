@extends('layouts.dashboard')
@section('title', __('Product list'))
@section('content')
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-blueGray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Product list') }}
                </h6>
                <div class="flex">
                    <form action="{{ route('vendor.product-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="excel" id="excel" placeholder="select a file" />
                        <button type="submit"
                            class="leading-4 md:text-sm sm:text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                            {{ __('Import') }}
                        </button>
                    </form>
                </div>

                <div class="flex">
                    <a class="md:text-sm sm:text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 text-sm font-bold uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                        href="{{ route('vendor.products.create') }}">
                        {{ __('Create product') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div>
                <div class="flex flex-wrap justify-center">
                    <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
                        <select wire:model="perPage"
                            class="w-20 block p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-300 mr-3">
                            @foreach ($paginationOptions as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        {{-- @can('client_product_management') --}}
                        <button
                            class="text-blue-500 dark:text-gray-300 bg-transparent dark:bg-dark-eval-2 border border-blue-500 dark:border-gray-300 hover:text-blue-700  active:bg-blue-600 font-bold uppercase text-xs p-3 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                            type="button" wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                            <x-heroicon-o-trash class="h-3 w-3" />
                        </button>
                        {{-- @endcan --}}
                    </div>
                    <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
                        <div class="">
                            <input type="text" wire:model.debounce.300ms="search"
                                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                placeholder="{{ __('Search') }}" />
                        </div>
                    </div>
                </div>
                <div wire:loading.delay>
                    Loading...
                </div>

                <x-table>
                    <x-slot name="thead">
                        <x-table.th>#</x-table.th>
                        <x-table.th>
                            {{ __('Code') }}
                        </x-table.th>
                        <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                            {{ __('Name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </x-table.th>
                        <x-table.th sortable wire:click="sortBy('stock')" :direction="$sorts['stock'] ?? null">
                            {{ __('Stock') }}
                            @include('components.table.sort', ['field' => 'stock'])
                        </x-table.th>
                        <x-table.th>
                            {{ __('Category') }}
                        </x-table.th>
                        <x-table.th>
                            {{ __('Price') }} / {{ __('Wholesale Price') }}
                        </x-table.th>
                        <x-table.th>
                            {{ __('Actions') }}
                        </x-table.th>
                        </tr>
                    </x-slot>
                    <x-table.tbody>
                        @forelse($products as $product)
                            <x-table.tr>
                                <x-table.td>
                                    <input type="checkbox" value="{{ $product->id }}" wire:model="selected">
                                </x-table.td>
                                <x-table.td>
                                    {{ $product->code }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $product->name }}
                                </x-table.td>
                                <x-table.td>
                                    <livewire:toggle-button :model="$product" field="stock" key="{{ $product->id }}" />
                                </x-table.td>
                                <x-table.td>
                                    
                                </x-table.td>

                                <x-table.td>
                                    {{ $product->price }} / {{ $product->old_price }}
                                </x-table.td>
                                <x-table.td>
                                    <div class="inline-flex">
                                        <a class="btn btn-sm text-white bg-green-500 border-green-800 hover:bg-green-600 active:bg-green-700 focus:ring-green-300"
                                            class="flex items-center space-x-2">
                                            <x-heroicon-o-eye class="h-4 w-4" />
                                        </a>
                                        <a class="btn btn-sm text-white bg-blue-500 border-blue-800 hover:bg-blue-600 active:bg-blue-700 focus:ring-blue-300 "
                                            class="flex items-center space-x-2">
                                            <x-heroicon-o-pencil-alt class="h-4 w-4" />
                                        </a>
                                        <button
                                            class="btn btn-sm text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300"
                                            type="button" wire:click="confirm('delete', {{ $product->id }})"
                                            wire:loading.attr="disabled">
                                            <x-heroicon-o-trash class="h-4 w-4" />
                                        </button>
                                        {{-- @endcan --}}
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @empty
                                <x-table.tr>
                                    <x-table.td colspan="10" class="text-center">
                                        {{ __('No entries found.') }}
                                    </x-table.td>
                                </x-table.tr>
                            @endforelse
                        </x-table.tbody>
                    </x-table>

                    <div class="p-4">
                        <div class="pt-3">
                            @if ($this->selectedCount)
                                <p class="text-sm leading-5">
                                    <span class="font-medium">
                                        {{ $this->selectedCount }}
                                    </span>
                                    {{ __('Entries selected') }}
                                </p>
                            @endif
                            {{ $products->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endsection
