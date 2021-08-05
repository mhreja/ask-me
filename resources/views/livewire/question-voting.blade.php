<span class="question-favorite" style="font-size: 15px !important;">
    <span>
        <a @auth href="javascript:void(0)" wire:click="like" @if($isVoted==0) style="cursor: pointer;" @endif @endauth>
            <i class="icon-thumbs-up" @if($isLiked==1) style="font-weight: bold; color: green;" @endif></i>
        </a>
        {{$upvotes}}
    </span>
    &nbsp; &nbsp; &nbsp;
    <span>
        <a @auth href="javascript:void(0)" wire:click="dislike" @if($isVoted==0) style="cursor: pointer;" @endif
            @endauth>
            <i class="icon-thumbs-down" @if($isDisliked==1) style="font-weight: bold; color: red;" @endif></i>
        </a>
        {{$downvotes}}
    </span>
</span>