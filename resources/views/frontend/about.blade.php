@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('head')

@endsection


@section('content')

<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>About Us</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">About Us</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content page-full-width">
    <div class="row">
        <div class="col-md-12">
            <div class="page-content">
                <div class="boxedtitle page-title">
                    <h2>About Us</h2>
                </div>
                <p><img alt="" src="{{asset('mhreja/assets/bgimages/images/demo/posts/loneliness-1440x900.jpg')}}"></p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in
                    felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu.</p>

                <blockquote>
                    <p>Quisque ligulas ipsum, euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu
                        ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in
                        semper vel, congue sed ligula.</p>
                </blockquote>

                <div class="f_left margin_b_20 margin_r_20" style="width: 220px">
                    <img alt=""
                        src="{{asset('mhreja/assets/bgimages/images/demo/posts/3d-cartoon-caracter2-300x225.jpg')}}"
                        width="260" height="195">
                </div>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit
                    amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas.</p>

                <div class="clearfix"></div>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in
                    felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in
                    felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                    posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat
                    venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in
                    felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu.</p>

                {{-- <div class="video_embed"><iframe height="600" src="http://www.youtube.com/embed/JuyB7NO0EYY"></iframe> --}}
            </div>
        </div><!-- End page-content -->
    </div><!-- End main -->
    </div><!-- End row -->
</section><!-- End container -->

@endsection

@section('scripts')

@endsection