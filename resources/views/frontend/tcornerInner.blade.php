@extends('frontend.layouts.app')

@section('title', $note->title)

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$note->title}}</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        <a href="{{route('tcorner')}}">
                            Today's Corner
                        </a>
                    </span>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        {{Str::limit($note->title, 25)}}
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
                    <a href="javascript:void(0)">{{$note->title}}</a>
                </h2>
                @if($note->pdf)
                <div class="question-type-main">
                    <a target="_blank" href="{{asset('storage/'.$note->pdf)}}" style="color: #fff;">Download PDF</a>
                </div>
                @endif
                <div class="question-inner">
                    <div class="question-desc">
                        {!! $note->description !!}
                        <br>
                        @if($note->image != NULL)
                        <img src="{{asset('storage/'.$note->image)}}" alt="todays conrer">
                        @endif
                    </div>
                </div>
            </article>

        </div><!-- End main -->
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')

@endsection