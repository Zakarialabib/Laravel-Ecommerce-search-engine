<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th class="pr-0 w-8">
                <input type="checkbox" wire:model="selectPage" />
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                {{ __('Subscription name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Subscription description') }}
            </x-table.th>
            <x-table.th>
                {{ __('Price') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse ($subscriptions as $subscription)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $subscription->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $subscription->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $subscription->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $subscription->details }}
                    </x-table.td>
                    <x-table.td>
                        {{ $subscription->pivot?->price }}
                    </x-table.td>
                    <x-table.td>
                        <x-button primary type="button" wire:click="$emit('editModal', {{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-edit"></i>
                        </x-button>
                        <x-button danger type="button" wire:click="$emit('deleteModal', {{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-trash-alt"></i>
                        </x-button>
                    </x-table.td>
                </x-table.tr>
            @empty
                <tr>
                    <td>{{ __('No entries found.') }}</td>
                </tr>
            @endforelse
        </x-table.tbody>
    </x-table>
</div>