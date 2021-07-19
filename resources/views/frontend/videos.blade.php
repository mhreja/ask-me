@extends('frontend.layouts.app')

@section('title', 'Videos')

@section('head')

@endsection


@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Videos</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">
                        Videos
                    </span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="page-content">
                <div class="boxedtitle page-title">
                    <h2>Videos</h2>
                </div>
                <div class="row">
                    @php
                    $videos = \App\Models\Video::latest()->paginate(9);
                    @endphp

                    @forelse ($videos as $item)
                    <div class="col-md-4">
                        <div class="video_embed">
                            @php
                            $link = $item->video_link;
                            $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...

                            if (empty($video_id[1])){
                            $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
                            }

                            $video_id = explode("&", $video_id[1]); // Deleting any other params
                            $video_id = $video_id[0];

                            @endphp

                            <iframe height="200" src="//www.youtube.com/embed/{{$video_id}}"></iframe>
                            <i>{{$item->title}}</i>
                        </div>
                    </div>
                    @empty
                    <center>Oops, No video found!</center>
                    @endforelse
                </div>
                <div style="padding: 10px;">
                    {{$videos->links()}}
                </div>
            </div><!-- End page-content -->
        </div>
    </div>
</section>
@endsection

@section('scripts')

@endsection