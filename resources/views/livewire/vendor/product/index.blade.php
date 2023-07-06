<div>

    @section('title', __('Product list'))

    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="flex items-center my-auto justify-between">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Product list') }}
                </h6>


                <a class="flex float-right md:text-sm sm:text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 text-sm font-bold uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                    href="">
                    {{ __('Create product') }}
                </a>
            </div>
        </div>
        <div class="p-4">

            <div class="flex flex-wrap justify-center">
                <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
                    <select wire:model="perPage"
                        class="w-20 block p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-300 mr-3">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <button
                        class="text-blue-500 dark:text-gray-300 bg-transparent dark:bg-dark-eval-2 border border-blue-500 dark:border-gray-300 hover:text-blue-700  active:bg-blue-600 font-bold uppercase text-xs p-3 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                        type="button" wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                        <i class="fas fa-trash-alt"></i>
                    </button>
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
                                <p>{{ Helpers::format_currency($product->price->price) }}</p>
                                @if ($product->price)
                                    <p>
                                        {{ $product->price->latestPrice()->old_price }}DH
                                    </p>
                                @endif
                                <p>
                                    {{ $product->price ? $product->price->wholesale_price : '' }}DH
                                </p>
                            </x-table.td>
                            <x-table.td>
                                <div class="inline-flex">
                                    <x-button info class="flex items-center space-x-2">
                                        <i class="fas fa-eye"></i>
                                    </x-button>
                                    <x-button secondary class="flex items-center space-x-2">
                                        <i class="fas fa-edit"></i>
                                    </x-button>
                                    <x-button danger type="button" wire:click="confirm('delete', {{ $product->id }})"
                                        wire:loading.attr="disabled">
                                        <i class="fas fa-trash"></i>
                                    </x-button>
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
