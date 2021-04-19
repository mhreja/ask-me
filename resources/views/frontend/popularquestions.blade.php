@extends('frontend.layouts.app')

@section('title', 'Popular Questions')

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Popular Questions</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Popular Questions</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            @forelse($popularQuestions as $item)
            <article class="question question-type-normal">
                <h2>
                    <a href="#">{{ Str::limit($item->title, 85,'...') }}</a>
                </h2>
                <a class="question-report" href="{{route('contact')}}">Report</a>
                <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                <div class="question-author">
                    <a href="javascript:void(0)" original-title="{{$item->user->username}}"
                        class="question-author-img tooltip-n"><span></span><img alt=""
                            src="{{$item->user->profile_photo_url}}"></a>
                </div>
                <div class="question-inner">
                    <div class="clearfix"></div>
                    <div class="questiondescription">
                        {!! Str::limit($item->details, 420,'...') !!}
                    </div>
                    <div class="question-details">
                        @if($item->has_admin_answered == true)
                        <span class="question-answered question-answered-done">
                            <i class="icon-ok"></i>{{ADMIN_ANSWERED}}
                        </span>
                        @elseif($item->answers->where('is_correct_marked', 1)->count() > 0)
                        <span class="question-answered">
                            <i class="icon-ok"></i>{{ADMIN_MARKED_CORRECT_ANSWER}}
                        </span>
                        @endif

                        @livewire('question-voting', [
                        'questionId'=>$item->id,
                        'upvotes'=>$item->upvotes,
                        'downvotes'=>$item->downvotes
                        ])

                    </div>
                    <span class="question-category">
                        <a href="#"><i class="icon-folder-close"></i>
                            {{$item->subject->subject}}&nbsp;&nbsp;
                        </a>
                    </span>
                    <span class="question-date"><i class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{$item->answers->count()}}
                            Answer</a></span>
                    {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                    <div class="clearfix"></div>
                </div>
            </article>
            @empty
            <p>Oops! No Questions Found</p>
            @endforelse

            <div style="float: right">
                {{ $popularQuestions->links() }}
            </div>
        </div>
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')

@endsection