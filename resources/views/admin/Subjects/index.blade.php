@extends('admin.layouts.app')

@section('title', 'Subjects')

@section('head')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Subjects</h1>
    </div>


    @livewire('add-subject')

    <div class="my-5">
        @livewire('subjects-table')
    </div>

</div>
@endsection

@section('scripts')
@endsection