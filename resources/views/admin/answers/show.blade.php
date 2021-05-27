@extends('admin.layouts.app')

@section('title', 'Answer - '.$answer->question->title)

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div>
        <span>
            <strong>Question:</strong> <a href="{{route('questions.show', $answer->question->id)}}"
                class="text-primary">
                {{$answer->question->title}}
            </a>
        </span>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Answer:</h1>

        <div>
            @if($answer->is_approved == 1)
            <span class="badge badge-success">Approved</span>
            @else
            <span class="badge badge-secondary">Pending</span>
            @endif

            @if($answer->is_correct_marked == 1)
            <span class="badge badge-primary"><i class="fa fa-check"></i> Correct</span>
            @endif

            @if($answer->rejection_comment != NULL)
            <span class="badge badge-danger"> Rejected</span>
            <br>
            <span class="font-italic text-danger">
                <small>{{$answer->rejection_comment}}</small>
            </span>
            @endif
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="d-flex">
                        <div>
                            <img alt="{{$answer->user->name}}" src="{{$answer->user->profile_photo_url}}"
                                class="rounded-circle" width="50px">
                        </div>
                        <p class="mx-2">
                            {{$answer->user->name}}
                            <br>
                            <i class="icon-time">{{$answer->created_at->diffForHumans()}}</i>
                        </p>
                    </div>
                </div>
                <div class="text-info">
                    {{$answer->upvotes}} Likes, {{$answer->downvotes}} Dislikes
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $answer->answer !!}
            <br>
            @if($answer->photo != NULL)
            <img src="{{asset('storage/'.$answer->photo)}}" alt="question" class="img-thumbnail">
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection