@extends('frontend.layouts.app')

@section('title', 'Todays Corner')

@section('head')
<style>
    .mycard {
        background: #fff;
        border-radius: 5px;
        margin-top: 11px;
    }

    .myimg {
        width: 100%;
        height: 180px;
    }

    .mycontent {
        padding: 20px;
    }
</style>
@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Today's Corner</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Today's Corner</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            @forelse($notes as $item)
            @include('frontend.inc.singleTcorner')
            @empty
            <p>Oops! No Today's Corner Found</p>
            @endforelse

            <div style="float: right">
                {{ $notes->links() }}
            </div>
        </div>
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')

@endsection