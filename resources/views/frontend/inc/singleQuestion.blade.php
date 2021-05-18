<article class="question question-type-normal">
    <h2>
        <a href="{{route('questionInner', $item->id)}}">{{ Str::limit($item->title, 85,'...') }}</a>
    </h2>
    @if($item->is_approved)
    <a class="question-report" href="{{route('contact')}}">Report</a>
    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
    @else
    @if ($item->rejection_comment == NULL)
    <div class="question-type-main" style="background: rgb(170, 7, 235);"><i class="icon-time"></i>Pending
    </div>
    @else
    <div class="question-type-main" style="background: rgb(235, 15, 7);"><i class="icon-circle"></i>Rejected
    </div>
    @endif
    @endif
    <div class="question-author">
        <a href="javascript:void(0)" original-title="{{$item->user->username}}"
            class="question-author-img tooltip-n"><span></span><img alt="" src="{{$item->user->profile_photo_url}}"></a>
    </div>
    <div class="question-inner">
        <div class="clearfix"></div>
        <div class="questiondescription">
            {!! Str::limit($item->details, 420,'...') !!}
        </div>

        @livewire('question-voting', [
        'questionId'=>$item->id,
        'upvotes'=>$item->upvotes,
        'downvotes'=>$item->downvotes
        ])
        <span class="question-category">
            <a href="{{route('subjectQuestions', $item->subject->id)}}"><i class="icon-folder-close"></i>
                {{$item->subject->subject}}&nbsp;&nbsp;
            </a>
        </span>
        <span class="question-date"><i class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
        <span class="question-comment">
            <a href="{{route('questionInner', $item->id)}}">
                <i class="icon-comment"></i>
                {{$item->answers->where('is_approved', 1)->count()}}
                Answer
            </a>
        </span>
        {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}

        <div class="question-details">
            @if($item->has_admin_answered == true)
            <span class="question-answered question-answered-done">
                <i l_background="#3498db" l_background_hover="#34495E" class="icon-ok-sign ul_l_circle"
                    style="background-color: rgb(30, 207, 45); color: rgb(255, 255, 255);"></i>{{ADMIN_ANSWERED}}
            </span>
            @elseif($item->answers->where('is_correct_marked', 1)->count() > 0)
            <span class="question-answered">
                <i l_background="#1abc9c" l_background_hover="#34495E" class="icon-ok ul_l_circle"
                    style="background-color: rgb(226, 71, 33); color: rgb(255, 255, 255);"></i>{{ADMIN_MARKED_CORRECT_ANSWER}}
            </span>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
</article>