@extends('admin.layouts.app')

@section('title', $question->title)

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div>
        <small>
            <a href="{{route('subjectQuestions', $question->subject->id)}}" class="text-primary">
                {{$question->subject->subject}}
            </a>
            <strong> / </strong>
            <a href="{{route('topicQuestions', $question->topic->id)}}" class="text-primary">
                {{$question->topic->topic}}
            </a>
        </small>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$question->title}}</h1>

        <div>
            @if($question->is_approved == 1)
            <span class="badge badge-success">Approved</span>
            @else
            <span class="badge badge-secondary">Pending</span>
            @endif

            @if($question->is_favorite == 1)
            <span class="badge badge-primary"><i class="fa fa-heart"></i> Favorite</span>
            @endif

            @if($question->has_admin_answered == 1)
            <span class="badge badge-warning"><i class="fa fa-check"></i>{{ADMIN_ANSWERED}}</span>
            @endif

            @if($question->rejection_comment != NULL)
            <span class="badge badge-danger"> Rejected</span>
            <br>
            <span class="font-italic text-danger">
                <small>{{$question->rejection_comment}}</small>
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
                            <img alt="{{$question->user->name}}" src="{{$question->user->profile_photo_url}}"
                                class="rounded-circle" width="50px">
                        </div>
                        <p class="mx-2">
                            {{$question->user->name}}
                            <br>
                            <i class="icon-time">{{$question->created_at->diffForHumans()}}</i>
                        </p>
                    </div>
                </div>
                <div class="text-info">
                    {{$question->answers->count()}} Answers
                    <br>
                    {{$question->upvotes}} Likes, {{$question->downvotes}} Dislikes
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('questions.update', $question->id)}}" method="POST" class="comment-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">
                        Title *
                    </label>
                    <input type="text" name="title" value="{{$question->title}}" class="form-control"
                        placeholder="Question Title">
                    @error('title')
                    <span style="color: #fe0000;">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea name="details">{{$question->details}}</textarea>
                    @error('details')
                    <span style="color: #f00; font-size: 12px;">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-info btn-block mb-4">Update</button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<!-- CK-Editor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'details' );
</script>
@endsection