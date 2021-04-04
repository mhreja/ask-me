@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('head')
@livewireStyles
@endsection


@section('content')

<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Contact Us</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Contact Us</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content page-full-width">
    <div class="row">
        <div class="contact-us">
            <div class="col-md-12">
                <div class="page-content">
                    <iframe height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d471220.5630409112!2d88.04953608529773!3d22.675752093263746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1617438850120!5m2!1sen!2sin"></iframe>
                </div><!-- End page-content -->
            </div>
            <div class="col-md-7">
                <div class="page-content">
                    <h2>Say hello !</h2>

                    @livewire('contact')

                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-5">
                <div class="page-content">
                    <h2>About Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet
                        suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate
                        posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce
                        placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a
                        semper lacus purus in felis.</p>
                    <div class="widget widget_contact">
                        <ul>
                            <li><i class="icon-map-marker"></i>Address :<p>Ask Me Network, 33 Street, syada Zeinab,
                                    Cairo, Egypt.</p>
                            </li>
                            <li><i class="icon-phone"></i>Phone number :<p>(+2)01111011110</p>
                            </li>
                            <li><i class="icon-envelope-alt"></i>E-mail :<p>info@example.com</p>
                            </li>
                            <li>
                                <i class="icon-share"></i>Social links :
                                <p>
                                    <a href="#" original-title="Facebook" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#3b5997"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-facebook"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="#" original-title="Twitter" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#00baf0"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-twitter"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Youtube" class="tooltip-n" href="#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#cc291f"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-youtube"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="#" original-title="Linkedin" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#006599"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-linkedin"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="#" original-title="Google plus" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#ca2c24"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-gplus"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="RSS" class="tooltip-n" href="#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#F18425"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="icon-rss"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Instagram" class="tooltip-n" href="#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#306096"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-instagram"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Dribbble" class="tooltip-n" href="#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#e64281"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-dribbble"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Pinterest" class="tooltip-n" href="#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#c7151a"
                                                span_hover="#2f3239">
                                                <i i_color="#FFF" class="icon-pinterest"></i>
                                            </span>
                                        </span>
                                    </a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End contact-us -->
    </div><!-- End row -->
</section><!-- End container -->

@endsection

@section('scripts')
@livewireScripts
@endsection