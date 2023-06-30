<div>
    <x-modal wire:model="renewModal">
        <x-slot name="title">
            {{ __('Renew User subscription') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="renew">
                <div class="lg:w-1/3 sm:w-1/2 px-2 mt-5 {{ $errors->has('start_date') ? 'is-invalid' : '' }}">
                    <label for="start_date">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" id="start_date" disabled wire:model="start_date" />
                    {{-- <x-input-error for="email" /> --}}
                </div>
                <div class="lg:w-1/3 sm:w-1/2 px-2 mt-5 {{ $errors->has('end_date') ? 'is-invalid' : '' }}">
                    <label for="end_date">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" id="end_date" wire:model="end_date" />
                    {{-- <x-input-error for="phone" /> --}}
                </div>
                <x-button type="submit" primaryF>
                    {{ __('Renew') }}
                </x-button>
            </form>
        </x-slot>
    </x-modal>
</div>
