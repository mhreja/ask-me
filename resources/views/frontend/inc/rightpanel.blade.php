<aside class="col-md-3 sidebar">
    <div class="widget widget_stats">
        <h3 class="widget_title">Stats</h3>
        <div class="ul_list ul_list-icon-ok">
            <ul>
                <li><i class="icon-book"></i>Subjects ( <span>{{$count['subject']}}</span> )</li>
                <li><i class="icon-bookmark"></i>Topics ( <span>{{$count['topic']}}</span> )</li>
                <li><i class="icon-question-sign"></i>Questions ( <span>{{$count['question']}}</span> )</li>
                <li><i class="icon-comment"></i>Answers ( <span>{{$count['answer']}}</span> )</li>
            </ul>
        </div>
    </div>

    @if($toprankers->count() > 0)
    <div class="widget widget_highest_points">
        <h3 class="widget_title">Highest points</h3>
        <ul>
            @foreach($toprankers as $user)

            <li>
                <div class="author-img">
                    <a href="javascript:void()"><img width="30" height="30" src="{{$user->profile_photo_url}}"
                            alt=""></a>
                </div>
                <h6><a href="javascript:void()">{{$user->name}}</a></h6>

                @if($user->points >= RANK1MINPOINTS)
                <p class="badge badge-platinum">
                    {{RANK1NAME}} -
                    {{$user->points}} Points
                </p>
                @elseif($user->points >= RANK2MINPOINTS)
                <p class="badge badge-gold">
                    {{RANK2NAME}} -
                    {{$user->points}} Points
                </p>
                @elseif($user->points >= RANK3MINPOINTS)
                <p class="badge badge-silver">
                    {{RANK3NAME}} -
                    {{$user->points}} Points
                </p>
                @elseif($user->points >= RANK4MINPOINTS)
                <p class="badge badge-bronze">
                    {{RANK4NAME}} -
                    {{$user->points}} Points
                </p>
                @else
                @endif

                <span class="comment"></span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($recentQuestions->count() > 0 && Route::current()->getName() != 'home')
    <div class="widget">
        <h3 class="widget_title">Recent Questions</h3>
        <ul class="related-posts">
            @foreach ($recentQuestions as $item)
            <li class="related-item">
                <h3><a href="{{route('questionInner', $item->id)}}">{{ Str::limit($item->title, 75,'...') }}</a></h3>
                <div class="clear"></div><span>{{$item->created_at->diffForHumans()}}</span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

</aside><!-- End sidebar -->