<div>
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="py-8 bg-gray-100">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap items-center justify-between -mx-4">
                    <div class="w-full md:w-auto px-4 mb-14 md:mb-0">
                        <h2 class="text-7xl md:text-8xl font-heading font-bold leading-relaxed">
                            {{ __('Account Settings') }}</h2>
                        <p class="text-gray-400 leading-8">
                            {{ 'Manage you account settings and set preferences.' }}
                        </p>
                    </div>
                    <div class="w-full md:w-auto px-4">
                        <div class="flex items-center">
                            <x-button primary type="button" wire:click="store" wire:loading.attr="disabled">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-4">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="store" class="pt-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="name">{{ __('Full Name') }}</label>
                        <x-input type="text" name="name" id="name" wire:model="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <x-input type="email" name="email" id="email" disabled wire:model="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="{{ $errors->has('phone') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="phone">{{ __('Phone') }}</label>
                        <x-input type="number" name="phone" id="phone" wire:model.lazy="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>


                    <div class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <x-input type="password" name="password" id="password" wire:model.lazy="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Country -->
                    <div>
                        <x-label for="country" :value="__('Country')" required />

                        <x-input id="country" class="block mt-1 w-full" wire:model.lazy="country" type="text"
                            name="country" :value="old('country')" disabled />
                    </div>

                    <!-- City -->
                    <div>
                        <x-label for="city" :value="__('City')" required />

                        <x-input id="city" class="block mt-1 w-full" wire:model.lazy="city" type="text"
                            name="city" :value="old('city')" required />
                    </div>

                    <div class="">
                        <x-input-label for="store_name" :value="__('Store Name')" required />

                        <x-input id="store_name" wire:model.lazy="store_name" type="text" name="store_name"
                            disabled />

                        <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
                    </div>
                    <div class="">
                        <x-input-label for="store_url" :value="__('Store URL')" required />

                        <x-input id="store_url" wire:model.lazy="store_url" type="text" name="store_url" />

                        <x-input-error :messages="$errors->get('store_url')" class="mt-2" required />
                    </div>

                    <div class="">
                        <x-input-label for="store_phone" :value="__('Store Phone')" required />

                        <x-input id="store_phone" wire:model.lazy="store_phone" type="number" name="store_phone"
                            required />

                        <x-input-error :messages="$errors->get('store_phone')" class="mt-2" />
                    </div>


                    <div class="col-span-full">
                        <x-input-label for="store_location" :value="__('Store Address')" required />

                        <x-input id="store_location" wire:model.lazy="store_location" type="text"
                            name="store_location" :value="old('store_location')" required />

                        <x-input-error :messages="$errors->get('store_location')" class="mt-2" />
                    </div>

                    <div class="col-span-full">
                        <x-input-label for="logo" :value="__('Logo')" required />

                        <x-input id="logo" wire:model.lazy="logo" type="file" name="logo"
                            :value="old('logo')" required />

                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <div class="col-span-full">
                        <x-input-label for="banner_image" :value="__('Banner Image')" required />

                        <x-input id="banner_image" wire:model.lazy="banner_image" type="file" name="banner_image"
                            :value="old('banner_image')" required />

                        <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                    </div>

                    <div class="col-span-full">
                        @foreach ($social_links as $index => $link)
                            <div class="flex flex-col">
                                <x-input-label for="social_links" :value="__('Social Links')" required />
                                <div class="flex flex-row">
                                    <x-input id="social_links" wire:model.lazy="social_links.{{ $index }}"
                                        type="text" name="social_links" :value="old('social_links')" required />
                                    <button wire:click.prevent="removeSocialLink({{ $index }})"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        X
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-5">
                    <x-button primary type="submit">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
