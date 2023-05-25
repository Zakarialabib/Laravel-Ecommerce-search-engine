<div>
    <x-modal wire:model="highlightModal">
        <x-slot name="title">
            {{ __('Highlight') }} - {{ $product?->name }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="saveHighlight">
                <div class="flex flex-wrap">
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="placement_type" :value="__('Placement Type')" />
                        <select id="placement_type" class="block mt-1 w-full" name="placement_type" wire:model="placement_type">
                            <option value="">-- {{ __('Select a placement type') }} --</option>
                            <option value="featured">{{ __('Featured') }}</option>
                            <option value="bestOffers">{{ __('Best Offers') }}</option>
                            <option value="latest">{{ __('Latest') }}</option>
                            <option value="trending">{{ __('Trending') }}</option>
                            <option value="sale">{{ __('Sale') }}</option>
                            <option value="other">{{ __('Other') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('placement_type')" for="placement_type" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="description" :value="__('Description')" />
                        <p id="description">{{ $highlightDescription }}</p>
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="duration" :value="__('Duration (days)')" />
                        <x-input id="duration" class="block mt-1 w-full" type="number" min="1" name="duration"
                            wire:model="duration" />
                        <x-input-error :messages="$errors->get('duration')" for="duration" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="start_date" :value="__('Start Date')" />
                        <x-input id="start_date" type="date" class="block mt-1 w-full" name="start_date" wire:model="start_date" />
                        <x-input-error :messages="$errors->get('start_date')" for="start_date" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="end_date" :value="__('End Date')" />
                        <x-input id="end_date" type="date" class="block mt-1 w-full" name="end_date" wire:model="end_date" />
                        <x-input-error :messages="$errors->get('end_date')" for="end_date" class="mt-2" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-label for="description" :value="__('Description')" />
                    <textarea id="description" class="block mt-1 w-full" name="description" rows="3" wire:model="description"></textarea>
                    <x-input-error :messages="$errors->get('description')" for="description" class="mt-2" />
                </div>
                <div class="w-full px-3 flex justify-center">
                    <x-button primary type="submit" class="block w-full text-center" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
