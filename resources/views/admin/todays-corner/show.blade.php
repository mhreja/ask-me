@extends('admin.layouts.app')

@section('title', 'Show Todays Corner')

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$note->title}}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Description</h3>
                <br>
                <small>Added On: {{date('d M, Y h:i A', strtotime($note->created_at))}}</small>
            </div>
        </div>
        <div class="card-body">
            {!! $note->description !!}


            <div class="my-5">
                @if($note->image)
                <a class="btn btn-sm btn-primary" target="_blank" href="{{asset('storage/'.$note->image)}}">
                    Show Image
                </a>
                @endif

                @if($note->pdf)
                <a class="btn btn-sm btn-info" target="_blank" href="{{asset('storage/'.$note->pdf)}}">
                    Open PDF
                </a>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

@endsection