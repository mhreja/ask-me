@extends('frontend.layouts.app')

@section('title', $question->title)

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$question->title}}</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        <a href="{{route('subjectQuestions', $question->subject->id)}}">
                            {{$question->subject->subject}}
                        </a>
                    </span>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        <a href="{{route('topicQuestions', $question->topic->id)}}">
                            {{$question->topic->topic}}
                        </a>
                    </span>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        {{Str::limit($question->title, 25)}}
                    </span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <article class="question single-question question-type-normal">
                <h2>
                    <a href="javascript:void(0)">{{$question->title}}</a>
                    <br>
                    <small>
                        <span class="question-category">
                            <a href="{{route('subjectQuestions', $question->subject->id)}}"><i
                                    class="icon-folder-close"></i>
                                {{$question->subject->subject}}&nbsp;&nbsp;
                            </a>
                        </span>
                        <span class="question-date">
                            <i class="icon-time"></i>
                            {{$question->created_at->diffForHumans()}}
                        </span>
                    </small>
                </h2>
                <a class="question-report" href="{{route('contact')}}">Report</a>
                <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                <div class="question-inner">
                    <div class="clearfix"></div>
                    <div class="question-desc">
                        {!! $question->details !!}
                        <br>
                        @if($question->photo != NULL)
                        <img src="{{asset('storage/'.$question->photo)}}" alt="question">
                        @endif
                    </div>

                    @livewire('question-voting', [
                    'questionId'=>$question->id,
                    'upvotes'=>$question->upvotes,
                    'downvotes'=>$question->downvotes
                    ])

                    @livewire('mark-fav', [
                    'questionId'=>$question->id
                    ])

                    <div class="question-details" style="float: right">
                        @if($question->has_admin_answered == true)
                        <span class="question-answered question-answered-done">
                            <i l_background="#3498db" l_background_hover="#34495E" class="icon-ok-sign ul_l_circle"
                                style="background-color: rgb(30, 207, 45); color: rgb(255, 255, 255);"></i>{{ADMIN_ANSWERED}}
                        </span>
                        @elseif($question->answers->where('is_correct_marked', 1)->count() > 0)
                        <span class="question-answered">
                            <i l_background="#1abc9c" l_background_hover="#34495E" class="icon-ok ul_l_circle"
                                style="background-color: rgb(226, 71, 33); color: rgb(255, 255, 255);"></i>{{ADMIN_MARKED_CORRECT_ANSWER}}
                        </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>


            @if($question->tags != NULL)
            <div class="share-tags page-content">
                <div class="question-tags"><i class="icon-tags"></i>

                    @php
                    $tagArr = explode(',', $question->tags);
                    @endphp

                    @foreach ($tagArr as $tag)
                    <a href="{{route('searchedQuestions')}}?keyword={{$tag}}">{{$tag}},</a>
                    @endforeach

                </div>
                <div>
                    <i class="icon-tags"></i>
                    Tags
                </div>
                <div class="clearfix"></div>
            </div>
            @endif

            <!-- Related Question -->
            @if($relatedQuestions->count() > 0)
            <div id="related-posts">
                <h2>Related Questions</h2>
                <ul class="related-posts">
                    @forelse ($relatedQuestions as $item)
                    <li class="related-item">
                        <h3>
                            <a href="{{route('questionInner', $item->id)}}">
                                <i class="icon-double-angle-right"></i>
                                {{$item->title}}
                            </a>
                        </h3>
                    </li>
                    @empty

                    @endforelse
                </ul>
            </div>
            @endif
            <!-- End of Related Question -->

            <!-- Answers Start -->
            @if($question->answers()->where('is_approved', 1)->count() > 0)
            <div id="commentlist" class="page-content">
                <div class="boxedtitle page-title">
                    <h2>Answers
                        ( <span class="color">{{$question->answers()->where('is_approved', 1)->count()}}</span> )
                    </h2>
                </div>
                <ol class="commentlist clearfix">
                    @forelse ($question->answers()->where('is_approved', 1)->get() as $item)
                    <li class="comment">
                        <div class="comment-body comment-body-answered clearfix">
                            <div class="avatar"><img alt="{{$item->user->name}}"
                                    src="{{$item->user->profile_photo_url}}"></div>
                            <div class="comment-text">
                                <div class="author clearfix">
                                    <div class="comment-author">
                                        <a href="#">
                                            {{$item->user->name}}

                                        </a>
                                        @if($item->user->is_admin == 1)
                                        <i l_background="#3498db" l_background_hover="#34495E"
                                            class="icon-ok-sign ul_l_circle"
                                            style="background-color: rgb(30, 207, 45); color: rgb(255, 255, 255);"></i>
                                        @endif

                                        @if($item->user->points >= RANK1MINPOINTS)
                                        <p class="badge badge-platinum">{{RANK1NAME}}</p>
                                        @elseif($item->user->points >= RANK2MINPOINTS)
                                        <p class="badge badge-gold">{{RANK2NAME}}</p>
                                        @elseif($item->user->points >= RANK3MINPOINTS)
                                        <p class="badge badge-silver">{{RANK3NAME}}</p>
                                        @elseif($item->user->points >= RANK4MINPOINTS)
                                        <p class="badge badge-bronze">{{RANK4NAME}}</p>
                                        @else
                                        @endif

                                    </div>
                                    <div class="comment-meta">
                                        <div class="date"><i
                                                class="icon-time"></i>{{$item->created_at->diffForHumans()}}</div>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        {!! $item->answer !!}
                                    </p>
                                    <br>
                                    @if($item->photo != NULL)
                                    <img src="{{asset('storage/'.$item->photo)}}" alt="answer">
                                    @endif
                                </div>
                                <div class="question-answered question-answered-done">
                                    @if($item->is_correct_marked == 1)
                                    <i class="icon-ok"></i>Correct Answer
                                    @endif
                                    @livewire('answer-voting', [
                                    'answerId'=>$item->id,
                                    'upvotes'=>$item->upvotes,
                                    'downvotes'=>$item->downvotes
                                    ])
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty

                    @endforelse
                </ol><!-- End commentlist -->
            </div><!-- End page-content -->
            @endif
            <!-- End of Answers-->

            @auth
            <div id="respond" class="comment-respond page-content clearfix">
                <div class="boxedtitle page-title">
                    <h2>
                        @if($question->answers()->where('is_approved', 1)->count() == 0)
                        Be the first to Answer
                        @else
                        Leave an answer
                        @endif
                    </h2>
                </div>
                <form action="{{route('storeAnswer')}}" method="POST" enctype="multipart/form-data" id="commentform"
                    class="comment-form">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <div id="respond-textarea">
                        <p>
                            <div>
                                <strong>
                                    Answer
                                </strong>
                                <span style="color: #f00; font-size: 12px;"> *</span>
                            </div>
                            <div>
                                <textarea name="answer">{{old('answer')}}</textarea>
                                <span style="color: #f00; font-size: 12px;">
                                    @error('answer')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </p>

                        <div class="row">
                            <div id="imagePreviewDiv" class="col-md-2">
                                <img class="imagePreview" src="{{asset('img/no-image.jpg')}}" width="150px"
                                    height="150px" style="border: 1px solid #cabdbc; padding: 1px">
                            </div>
                            <div class="col-md-10">
                                <p>
                                    <div style="margin-top:">
                                        <strong>Image</strong>
                                    </div>
                                    <div>
                                        <input type="file" id="customFile" name="image" accept="image/*">
                                        @error('image')
                                        <p>
                                            <span style="color: #f00; font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                        </p>
                                        @enderror
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit" value="Post your answer"
                            class="button small color">
                    </p>
                </form>
            </div>
            @endauth

        </div><!-- End main -->
        @include('frontend.inc.rightpanel')
    </div>
</section>

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