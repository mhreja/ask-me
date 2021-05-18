@extends('frontend.layouts.app')

@section('title', $topic->subject->subject .' - '. $topic->topic)

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$topic->subject->subject .' - '. $topic->topic}}</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        <a href="{{route('subjectQuestions', $topic->subject->id)}}">
                            {{$topic->subject->subject}}
                        </a>
                    </span>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        {{$topic->topic}}
                    </span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            @forelse($questions as $item)
            @include('frontend.inc.singleQuestion')
            @empty
            <p>Oops! No Questions Found</p>
            @endforelse

            <div style="float: right">
                {{ $questions->links() }}
            </div>
        </div>
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')

@endsection