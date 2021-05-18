@extends('frontend.layouts.app')

@section('title', 'Not Answered Questions')

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Not Answered Questions</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Not Answered Questions</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            @forelse($notAnsweredQuestions as $item)
            @include('frontend.inc.singleQuestion')
            @empty
            <p>Oops! No Questions Found</p>
            @endforelse

            <div style="float: right">
                {{ $notAnsweredQuestions->links() }}
            </div>
        </div>
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')

@endsection