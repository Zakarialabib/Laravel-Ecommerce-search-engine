<div>
    <div class="mx-12 mt-12">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ __('Advertisement') }}
            @isset($type)
                {{ $type }}
            @endisset
        </h5>
        <div class="overflow-x-auto relative">
            <livewire:table.ads.my-ads-table params="{{ $type }}" />
        </div>

        <x-modal wire:model="showModal">
            <x-slot name="title">
                <h3 class="text-xl font-medium text-capitalize text-gray-900 pl-3">
                    Update Advertisement
                </h3>
            </x-slot>
            <x-slot name="content">

                <!-- Modal body -->
                <form wire:submit.prevent="store" class="p-3 space-y-6">
                    <div class="w-full px-3 pb-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="title">
                            {{ __('Title') }}
                        </label>
                        <input wire:model="ads_title" class="w-full border rounded p-2" id="grid-password"
                            type="text" placeholder="">
                        <p class="text-gray-600 text-xs italic">Enter advertisement title</p>
                    </div>

                    <!-- Modal footer -->
                    <div
                        class="flex justify-between items-center p-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button wire:click="_reset" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save</button>
                    </div>
                </form>
            </x-slot>
        </x-modal>
    </div>
</div>
