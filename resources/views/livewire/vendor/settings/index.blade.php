@extends('layouts.dashboard')
@section('title', __('Store Settings'))
@section('content')
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="py-8 bg-gray-100">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap items-center justify-between -mx-4">
                    <div class="w-full md:w-auto px-4 mb-14 md:mb-0">
                        <h2 class="text-7xl md:text-8xl font-heading font-bold leading-relaxed">
                            {{ __('Store Settings') }}</h2>
                        <p class="text-gray-400 leading-8">
                            {{ 'Manage you store settings and set preferences.' }}
                        </p>
                    </div>
                    <div class="w-full md:w-auto px-4">
                        <div class="flex items-center">
                            {{-- <x-button primary type="button" wire:click="store" wire:loading.attr="disabled">
                                {{ __('Save') }}
                            </x-button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-4">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            
            {{-- <img src="{{ $this->generateQRCode() }}"> --}}

        </div>
    </div>
@endsection
