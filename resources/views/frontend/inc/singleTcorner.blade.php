<div class="col-md-4">
    <div class="mycard">

        <a href="{{route('tcorner.inner', $item->id)}}">
            @if($item->image)
            <img class="myimg" src="{{asset('storage/'.$item->image)}}" alt="{{$item->title}}">
            @else
            <img class="myimg" src="{{asset('img/no-image.jpg')}}" alt="{{$item->title}}">
            @endif
        </a>
        <div class="mycontent">
            <a href="{{route('tcorner.inner', $item->id)}}">
                <h3 style="margin-bottom: 0px !important;">{{$item->title}}</h3>
            </a>
            <small>{{$item->created_at->diffForHumans()}}</small>
            <div style="margin-top: 15px !important;">
                <a href="{{route('tcorner.inner', $item->id)}}">
                    {!! Str::limit($item->description, 90,'...') !!}
                </a>
            </div>
        </div>
    </div>
</div>