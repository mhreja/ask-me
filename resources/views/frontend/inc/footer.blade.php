<footer id="footer">
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget_contact">
                    <h3 class="widget_title">Who We Are ?</h3>
                    <img src="{{asset('mhreja/assets/images/logo.png')}}" alt="{{config('app.name', 'Laravel')}}">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio,
                        sit amet suscipit risus ultrices eu.</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="widget">
                    <h3 class="widget_title">Quick Links</h3>
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('register')}}">Register</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h3 class="widget_title">Questions</h3>
                    <ul class="related-posts">
                        <li><a href="{{route('askquestion.index')}}">Ask Question</a></li>
                        <li><a href="{{route('recentquestions')}}">Recent Questions</a></li>
                        <li><a href="{{route('popularquestions')}}">Popular Questions</a></li>
                        <li><a href="{{route('mostansweredquestions')}}">Most Answered Questions</a></li>
                        <li><a href="{{route('notansweredquestions')}}">Not Answered Questions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget_contact">
                    <h3 class="widget_title">Contact</h3>
                    <ul>
                        <li>
                            <i class="icon-map-marker" style="font-size: 20px;"></i>
                            {{ADDRESS}}
                        </li>
                        <li>
                            <i class="icon-mobile-phone" style="font-size: 22px;"></i> {{PHONE}}
                        </li>
                        <li><i class="icon-envelope-alt" style="font-size: 14px;"></i> {{EMAIL}}</li>
                    </ul>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</footer><!-- End footer -->
<footer id="footer-bottom">
    <section class="container">
        <div class="copyrights f_left">
            Copyright &copy; {{ config('app.name', 'Laravel') }} {{date('Y')}}
            | All Rights Reserved | Powered by
            <a original-title="Call: 9593352884" class="tooltip-n" href="javascript:void(0)">Md Hossain Reja</a>
        </div>
        <div class="social_icons f_right">
            <ul>
                <li class="twitter"><a original-title="Twitter" class="tooltip-n" href="{{TWITTER_URL}}"><i
                            class="social_icon-twitter font17"></i></a></li>
                <li class="facebook"><a original-title="Facebook" class="tooltip-n" href="{{FACEBOOK_URL}}"><i
                            class="social_icon-facebook font17"></i></a></li>
                <li class="youtube"><a original-title="Youtube" class="tooltip-n" href="{{YOUTUBE_URL}}"><i
                            class="social_icon-youtube font17"></i></a></li>

            </ul>
        </div><!-- End social_icons -->
    </section><!-- End container -->
</footer><!-- End footer-bottom -->