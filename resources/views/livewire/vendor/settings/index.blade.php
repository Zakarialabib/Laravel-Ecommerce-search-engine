@extends('layouts.dashboard')
@section('title', __('Store Settings'))
@section('content')
    <div class="card bg-white dark:bg-dark-eval-1">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Store Settings') }}
                </h6>
            </div>
        </div>
        <div class="p-4">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            
            <img src="{{ $this->generateQRCode() }}">

        </div>
    </div>
@endsection
