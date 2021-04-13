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

    <div class="card border-left-success shadow">
        <div class="card-body">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Add New Subject</div>
            @livewire('add-subject')
        </div>
    </div>

    <div class="my-5">
        @livewire('subjects-table')
    </div>

</div>
@endsection

@section('scripts')
@endsection