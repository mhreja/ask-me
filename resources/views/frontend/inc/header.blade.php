<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="{{route('home')}}"><img alt="" src="{{asset('mhreja/assets/images/logo.png')}}"></a>
        </div>
        <nav class="navigation">
            <ul>
                <li class="{{Request::route()->getName()=='home' ? 'current_page_item' : ''}}"><a
                        href="{{route('home')}}">Home</a>
                </li>
                <li
                    class="ask_question {{Request::route()->getName()=='askquestion.index' ? 'current_page_item' : ''}}">
                    <a href="{{route('askquestion.index')}}">
                        <img src="{{asset('mhreja/assets/images/mypen.svg')}}" style="display: inline;" width="32px"
                            height="32px">
                        Ask Question
                    </a>
                </li>
                <li><a href="cat_question.html">Questions</a>
                    <ul>
                        <li><a href="cat_question.html">Questions Category</a></li>
                        <li><a href="single_question.html">Question Single</a></li>
                        <li><a href="single_question_poll.html">Poll Question Single</a></li>
                    </ul>
                </li>
                <li
                    class="@if(in_array(Request::route()->getName(), ['login', 'register', 'myprofile.show',])) current_page_item @endif">
                    <a href="javascript: void(0)">My Account</a>
                    @guest
                    <ul>
                        <li class="{{Request::route()->getName()=='login' ? 'current_page_item' : ''}}">
                            <a href="{{route('login')}}">Login</a>
                        </li>
                        <li class="{{Request::route()->getName()=='register' ? 'current_page_item' : ''}}">
                            <a href="{{route('register')}}">Register</a>
                        </li>
                    </ul>
                    @endguest

                    @auth
                    <ul>
                        <li class="{{Request::route()->getName()=='myprofile.show' ? 'current_page_item' : ''}}">
                            <a href="{{route('myprofile.show')}}">My Profile</a>
                        </li>
                        <li><a href="user_questions.html">My Questions</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                    @endauth
                </li>
                <li class="{{Request::route()->getName()=='about' ? 'current_page_item' : ''}}">
                    <a href="{{route('about')}}">About Us</a>
                </li>
                <li class="{{Request::route()->getName()=='contact' ? 'current_page_item' : ''}}">
                    <a href="{{route('contact')}}">Contact Us</a>
                </li>
            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->