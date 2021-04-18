<section class="container main-content">
    <div class="row">
        <div class="col-md-9">

            <div class="tabs-warp question-tab">
                <ul class="tabs">
                    <li class="tab"><a href="#" class="current">Recent Questions</a></li>
                    <li class="tab"><a href="#">Most Popular</a></li>
                    <li class="tab"><a href="#">Most Answered</a></li>
                    <li class="tab"><a href="#">Not Answered</a></li>
                </ul>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($recentQuestions as $item)
                        <article class="question question-type-normal">
                            <h2>
                                <a href="#">{{$item->title}}</a>
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
                                    {!! $item->details !!}
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

                                    @livewire('like-dislike', [
                                    'upvotes'=>$item->upvotes,
                                    'downvotes'=>$item->downvotes
                                    ])

                                </div>
                                <span class="question-category">
                                    <a href="#"><i class="icon-folder-close"></i>
                                        {{$item->subject->subject}}&nbsp;&nbsp;
                                    </a>
                                </span>
                                <span class="question-date"><i
                                        class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
                                <span class="question-comment"><a href="#"><i
                                            class="icon-comment"></i>{{$item->answers->count()}}
                                        Answer</a></span>
                                {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                                <div class="clearfix"></div>
                            </div>
                        </article>
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($recentQuestions->count() > 0)
                        <a href="#" class="load-questions"><i class="icon-circle-arrow-right"></i>View More Recent
                            Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($mostPopularQuestions as $item)
                        <article class="question question-type-normal">
                            <h2>
                                <a href="#">{{$item->title}}</a>
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
                                    {!! $item->details !!}
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

                                    @livewire('like-dislike', [
                                    'upvotes'=>$item->upvotes,
                                    'downvotes'=>$item->downvotes
                                    ])

                                </div>
                                <span class="question-category">
                                    <a href="#"><i class="icon-folder-close"></i>
                                        {{$item->subject->subject}}&nbsp;&nbsp;
                                    </a>
                                </span>
                                <span class="question-date"><i
                                        class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
                                <span class="question-comment"><a href="#"><i
                                            class="icon-comment"></i>{{$item->answers->count()}}
                                        Answer</a></span>
                                {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                                <div class="clearfix"></div>
                            </div>
                        </article>
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($mostPopularQuestions->count() > 0)
                        <a href="#" class="load-questions"><i class="icon-circle-arrow-right"></i>View More Popular
                            Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($mostAnsweredQuestions as $item)
                        <article class="question question-type-normal">
                            <h2>
                                <a href="#">{{$item->title}}</a>
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
                                    {!! $item->details !!}
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

                                    @livewire('like-dislike', [
                                    'upvotes'=>$item->upvotes,
                                    'downvotes'=>$item->downvotes
                                    ])

                                </div>
                                <span class="question-category">
                                    <a href="#"><i class="icon-folder-close"></i>
                                        {{$item->subject->subject}}&nbsp;&nbsp;
                                    </a>
                                </span>
                                <span class="question-date"><i
                                        class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
                                <span class="question-comment"><a href="#"><i
                                            class="icon-comment"></i>{{$item->answers->count()}}
                                        Answer</a></span>
                                {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                                <div class="clearfix"></div>
                            </div>
                        </article>
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($mostAnsweredQuestions->count() > 0)
                        <a href="#" class="load-questions"><i class="icon-circle-arrow-right"></i>View More Most
                            Answered Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($notAnsweredQuestions as $item)
                        <article class="question question-type-normal">
                            <h2>
                                <a href="#">{{$item->title}}</a>
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
                                    {!! $item->details !!}
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

                                    @livewire('like-dislike', [
                                    'upvotes'=>$item->upvotes,
                                    'downvotes'=>$item->downvotes
                                    ])

                                </div>
                                <span class="question-category">
                                    <a href="#"><i class="icon-folder-close"></i>
                                        {{$item->subject->subject}}&nbsp;&nbsp;
                                    </a>
                                </span>
                                <span class="question-date"><i
                                        class="icon-time"></i>{{$item->created_at->diffForHumans()}}</span>
                                <span class="question-comment"><a href="#"><i
                                            class="icon-comment"></i>{{$item->answers->count()}}
                                        Answer</a></span>
                                {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                                <div class="clearfix"></div>
                            </div>
                        </article>
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($notAnsweredQuestions->count() > 0)
                        <a href="#" class="load-questions"><i class="icon-circle-arrow-right"></i>View More Unanswered
                            Questions</a>
                        @endif
                    </div>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('frontend.inc.rightpanel')
    </div><!-- End row -->
</section><!-- End container -->