@if(\App\Models\Dailyquestion::where('is_active', 1)->count() > 0)
<div class="container">
    <div class="carousel-all testimonial-carousel testimonial-warp-2" carousel_responsive="true" carousel_auto="true"
        carousel_effect="scroll">
        <div class="caroufredsel_wrapper"
            style="display: block; text-align: start; float: none; position: relative; inset: auto; z-index: auto; width: 535px; height: 120px; margin: 0px; overflow: hidden;">
            <div class="slides"
                style="text-align: left; float: none; position: absolute; inset: 0px auto auto 0px; margin: 0px; width: 3745px; height: 120px; z-index: auto;">


                @foreach (\App\Models\Dailyquestion::where('is_active', 1)->latest()->take(5)->get() as $each)
                <div class="testimonial-warp">
                    <a href="{{route('dailymcq.list')}}" target="_blank">
                        <div class="testimonial">
                            {!! nl2br($each->mcq) !!}
                            <span class="testimonial-f-arrow"></span>
                            <span class="testimonial-l-arrow"></span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-pagination" style="display: block;">
        </div>
    </div>
</div>
@endif