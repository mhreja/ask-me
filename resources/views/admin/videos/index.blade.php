@extends('admin.layouts.app')

@section('title', 'Videos')

@section('head')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Videos</h1>
    </div>


    @livewire('add-video')

    <div class="my-5">
        @livewire('videos-table')
    </div>

</div>
@endsection

@section('scripts')
@endsection