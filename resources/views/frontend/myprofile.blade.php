@extends('frontend.layouts.app')

@section('title','Profile')

@section('head')
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<style>
    .logo img {
        margin-top: 15px;
    }

    .text-lg {
        font-size: 18px !important;
    }

    button {
        font-size: 12px !important;
    }

    .mt-4,
    .mt-3,
    .mt-1,
        {
        font-size: 15px !important;
    }

    label,
    p {
        font-size: 10px !important;
    }
</style>

@livewireStyles

@endsection

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div>
    <div class="container">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="my-5">
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
        </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="my-5">
            @livewire('profile.update-password-form')


            <x-jet-section-border />
        </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="my-5">
            @livewire('profile.two-factor-authentication-form')


            <x-jet-section-border />
        </div>
        @endif

        <div class="my-5">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        <!-- <x-jet-section-border /> -->

        <!-- <div class="mt-10 sm:mt-0"> -->
        <!-- @ livewire('profile.delete-user-form') -->
        <!-- Remove the space after @ in above line -->
        <!-- </div> -->
    </div>
</div>
@endsection

@section('scripts')
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>

@stack('modals')
@livewireScripts
@endsection