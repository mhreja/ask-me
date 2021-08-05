@if($isMarkedFav == 0)
<a @auth href="javascript:void(0)" wire:click="markFav" @endauth>
    <i class="icon-star-empty ul_l_circle" style="background-color: rgb(52, 73, 94); color: rgb(255, 255, 255);"></i>
    Mark as Favorite
</a>
@else
<span>
    <i class="icon-star ul_l_circle" style="background-color: rgb(231, 76, 60); color: rgb(255, 255, 255);"></i>
    Marked As Favorite
</span>
@endif