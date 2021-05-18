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
                        @include('frontend.inc.singleQuestion')
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($recentQuestions->count() > 0)
                        <a href="{{route('recentquestions')}}" class="load-questions"><i
                                class="icon-circle-arrow-right"></i>View More Recent
                            Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($mostPopularQuestions as $item)
                        @include('frontend.inc.singleQuestion')
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($mostPopularQuestions->count() > 0)
                        <a href="{{route('popularquestions')}}" class="load-questions"><i
                                class="icon-circle-arrow-right"></i>View More Popular
                            Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($mostAnsweredQuestions as $item)
                        @include('frontend.inc.singleQuestion')
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($mostAnsweredQuestions->count() > 0)
                        <a href="{{route('mostansweredquestions')}}" class="load-questions"><i
                                class="icon-circle-arrow-right"></i>View More Most
                            Answered Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @forelse($notAnsweredQuestions as $item)
                        @include('frontend.inc.singleQuestion')
                        @empty
                        <p>Oops! No Questions Found</p>
                        @endforelse

                        @if($notAnsweredQuestions->count() > 0)
                        <a href="{{route('notansweredquestions')}}" class="load-questions"><i
                                class="icon-circle-arrow-right"></i>View More Unanswered
                            Questions</a>
                        @endif
                    </div>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('frontend.inc.rightpanel')
    </div><!-- End row -->
</section><!-- End container -->