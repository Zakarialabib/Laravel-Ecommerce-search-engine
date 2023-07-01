<div>
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Account Settings') }}
                </h6>
            </div>
        </div>
        <div class="p-4">
            <div>
                <!-- Validation Errors -->
                <x-validation-errors class="mb-4" :errors="$errors" />

                <form wire:submit.prevent="submit" class="pt-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="name">{{ __('Full Name') }}</label>
                            <x-input type="text" name="name" id="name" wire:model="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="email">{{ __('Email') }}</label>
                            <input
                                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                type="email" name="email" id="email" disabled wire:model="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="{{ $errors->has('phone') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="phone">{{ __('Phone') }}</label>
                            <input
                                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                type="number" name="phone" id="phone" wire:model="phone">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>


                        <div class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            <input
                                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                type="password" name="password" id="password" wire:model="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="">
                            <x-input-label for="store_name" :value="__('Store Name')" required />

                            <x-text-input id="store_name" wire:model.lazy="store_name" class="block mt-1 w-full"
                                type="text" name="store_name" :value="old('store_name')" required />

                            <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="store_url" :value="__('Store URL')" required />

                            <x-text-input id="store_url" wire:model.lazy="store_url" class="block mt-1 w-full"
                                type="text" name="store_url" :value="old('store_url')" />

                            <x-input-error :messages="$errors->get('store_url')" class="mt-2" required />
                        </div>

                        <div class="">
                            <x-input-label for="store_phone" :value="__('Store Phone')" required />

                            <x-text-input id="store_phone" wire:model.lazy="store_phone" class="block mt-1 w-full"
                                type="number" name="store_phone" :value="old('store_phone')" required />

                            <x-input-error :messages="$errors->get('store_phone')" class="mt-2" />
                        </div>


                        <div class="col-span-full">
                            <x-input-label for="store_address" :value="__('Store Address')" required />

                            <x-text-input id="store_address" wire:model.lazy="store_address" class="block mt-1 w-full"
                                type="text" name="store_address" :value="old('store_address')" required />

                            <x-input-error :messages="$errors->get('store_address')" class="mt-2" />
                        </div>
                        <div class="col-span-full">
                            <x-input-label for="logo" :value="__('Logo')" required />

                            <x-input id="logo" wire:model.lazy="logo" class="block mt-1 w-full" type="file"
                                name="logo" :value="old('logo')" required />

                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="col-span-full">
                            <x-input-label for="banner_image" :value="__('Banner Image')" required />

                            <x-input id="banner_image" wire:model.lazy="banner_image" class="block mt-1 w-full"
                                type="file" name="banner_image" :value="old('banner_image')" required />

                            <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                        </div>

                        <div class="col-span-full">
                            @foreach ($social_links as $index => $link)
                                <div class="flex flex-col">
                                    <x-input-label for="social_links" :value="__('Social Links')" required />
                                    <div class="flex flex-row">
                                        <x-input id="social_links" wire:model.lazy="social_links.{{ $index }}"
                                            class="block mt-1 w-full" type="text" name="social_links"
                                            :value="old('social_links')" required />
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
</div>
