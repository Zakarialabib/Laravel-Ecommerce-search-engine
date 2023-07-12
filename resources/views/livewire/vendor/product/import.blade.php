<div>
    <x-modal wire:model="importModal">
        <x-slot name="title">
            {{ __('Import Excel') }}
        </x-slot>

        <x-slot name="content">
            <div class="w-full py-2">
                <x-table-responsive>
                    <x-table.tr>
                        <x-table.th>{{ __('Name') }}</x-table.th>
                        <x-table.td>
                            <x-badge danger>
                                {{ __('Required') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Description') }}</x-table.th>
                        <x-table.td>
                            <x-badge danger>
                                {{ __('Required') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Price') }}</x-table.th>
                        <x-table.td>
                            <x-badge danger>
                                {{ __('Required') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Old price') }}</x-table.th>
                        <x-table.td>
                            <x-badge alert>
                                {{ __('Optional') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Category name') }}</x-table.th>
                        <x-table.td>
                            <x-badge danger>
                                {{ __('Required') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Subcategory name') }}</x-table.th>
                        <x-table.td>
                            <x-badge alert>
                                {{ __('Optional') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>

                    <x-table.tr>
                        <x-table.th>{{ __('Brand') }}</x-table.th>
                        <x-table.td>
                            <x-badge alert>
                                {{ __('Optional') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Image') }}</x-table.th>
                        <x-table.td>
                            <x-badge danger>
                                {{ __('Required') }}
                            </x-badge>
                        </x-table.td>
                    </x-table.tr>

                </x-table-responsive>
                <form wire:submit.prevent="import">
                    <div class="flex flex-wrap gap-4">
                        <div class="w-1/2 my-2">
                            <x-label for="import_file" :value="__('Import')" />
                            <x-input id="file" class="block mt-1 w-full" type="file" name="file"
                                wire:model.defer="file" />
                            <x-input-error :messages="$errors->get('file')" for="file" class="mt-2" />
                        </div>
                        <div class="w-1/2 my-2">
                            <x-button primary type="submit" class="block" wire:loading.attr="disabled">
                                {{ __('Import') }}
                            </x-button>
                            <span wire:loading.delay wire:target="import">
                                {{ __('Loading...') }}
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </x-slot>
    </x-modal>
</div>
