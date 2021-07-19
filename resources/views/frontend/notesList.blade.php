@extends('frontend.layouts.app')

@section('title', 'Notes')

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
                <h1>Notes</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Notes</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @forelse($notes as $item)
                @include('frontend.inc.singleNote')
                @empty
                <p>Oops! No Notes Found</p>
                @endforelse
            </div>

            <div style="float: right">
                {{ $notes->links() }}
            </div>
        </div>
        @include('frontend.inc.rightpanel')
    </div>
</section>

@endsection

@section('scripts')
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection