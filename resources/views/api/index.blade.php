@extends('admin.layouts.app')

@section('title','API Tokens')

@section('head')
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

@livewireStyles

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
@endsection

@section('content')
<div>
	<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
	    @livewire('api.api-token-manager')
	</div>
</div>
@endsection

@section('scripts')
  @stack('modals')
  @livewireScripts
@endsection