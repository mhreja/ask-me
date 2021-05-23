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
            {!! $question->details !!}
            <br>
            @if($question->photo != NULL)
            <img src="{{asset('storage/'.$question->photo)}}" alt="question" class="img-thumbnail">
            @endif
        </div>
    </div>


    <div class="bg-info clearfix">
        <button class="btn btn-primary float-left">
            Answers
        </button>
        <a href="#replyAnswer" class="btn btn-warning float-right">
            Submit an answer
        </a>
    </div>

    <!-- Answers Start -->
    @forelse ($question->answers as $item)
    <div class="card shadow my-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="d-flex">
                        <div>
                            <img alt="{{$item->user->name}}" src="{{$item->user->profile_photo_url}}"
                                class="rounded-circle" width="50px">
                        </div>
                        <p class="mx-2">
                            @if($item->user->is_admin == 1)<i class="fa fa-star text-primary"></i>@endif
                            {{$item->user->name}}
                            <br>
                            <i class="icon-time">{{$item->created_at->diffForHumans()}}</i>
                        </p>
                    </div>
                </div>
                <div class="text-info">
                    @if($item->is_approved == 1)
                    <span class="badge badge-success">Approved</span>
                    @else
                    <span class="badge badge-secondary">Pending</span>
                    @endif

                    @if($item->is_correct_marked == 1)
                    <span class="badge badge-warning"><i class="fa fa-check"></i>{{ADMIN_MARKED_CORRECT_ANSWER}}</span>
                    @endif

                    @if($item->rejection_comment != NULL)
                    <span class="badge badge-danger"> Rejected</span>
                    <br>
                    <span class="font-italic text-danger">
                        <small>{{$item->rejection_comment}}</small>
                    </span>
                    @endif

                    <br>
                    {{$item->upvotes}} Likes, {{$item->downvotes}} Dislikes
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $item->answer !!}
            <br>
            @if($item->photo != NULL)
            <img src="{{asset('storage/'.$item->photo)}}" alt="answer" class="img-thumbnail">
            @endif
        </div>
    </div>
    @empty

    @endforelse
    <!-- End of Answers-->


    <div class="card shadow my-3" id="replyAnswer">
        <div class="card-header">
            <h2>
                @if($question->answers()->where('is_approved', 1)->count() == 0)
                Be the first to Answer
                @else
                Leave an answer
                @endif
            </h2>
        </div>
        <div class="card-body">
            <form action="{{route('storeAnswer')}}" method="POST" enctype="multipart/form-data" id="commentform"
                class="comment-form">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <div class="mb-4">
                    <textarea name="answer">{{old('answer')}}</textarea>
                    @error('answer')
                    <span style="color: #f00; font-size: 12px;">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div id="imagePreviewDiv" class="col-md-2">
                        <img class="imagePreview" src="{{asset('img/no-image.jpg')}}" width="150px" height="150px"
                            style="border: 1px solid #cabdbc; padding: 1px">
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" id="customFile" name="image" accept="image/*">
                            @error('image')
                            <span style="color: #f00; font-size: 12px;">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block mb-4">Publish Answer</button>
            </form>
        </div>
    </div>





</div>
@endsection

@section('scripts')
<!-- CK-Editor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'answer' );
</script>


<!-- Image Preview -->
<script>
    const customFile = document.getElementById("customFile");
    const previewContainer = document.getElementById("imagePreviewDiv");
    const previewImage = previewContainer.querySelector(".imagePreview");
    
    customFile.addEventListener("change", function(){
        const file = this.files[0];
 
        if(file){
            const reader = new FileReader();
 
            previewImage.style.display = "flex";
 
            reader.addEventListener("load",function(){
                //console.log(this);
                previewImage.setAttribute("src",this.result);
            });
 
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection