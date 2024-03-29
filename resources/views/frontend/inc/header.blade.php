<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="{{route('home')}}"><img alt="{{config('app.name', 'Laravel')}}"
                    src="{{asset('mhreja/assets/images/logo.png')}}"></a>
        </div>
        <nav class="navigation">
            <ul>
                <li class="{{Request::route()->getName()=='home' ? 'current_page_item' : ''}}"><a
                        href="{{route('home')}}">Home</a>
                </li>
                <li
                    class="ask_question {{Request::route()->getName()=='askquestion.index' ? 'current_page_item' : ''}}">
                    <a href="{{route('askquestion.index')}}">

                        Ask Question
                        <img src="{{asset('mhreja/assets/images/mypen.svg')}}" style="display: inline;" width="32px"
                            height="32px">
                    </a>
                </li>
                <li
                    class="@if(in_array(Request::route()->getName(), ['recentquestions', 'popularquestions', 'mostansweredquestions', 'notansweredquestions'])) current_page_item @endif">
                    <a href="javascript:void(0)">Questions</a>
                    <ul>
                        <li><a href="{{route('recentquestions')}}">Recent Questions</a></li>
                        <li><a href="{{route('popularquestions')}}">Popular Questions</a></li>
                        <li><a href="{{route('mostansweredquestions')}}">Most Answered</a></li>
                        <li><a href="{{route('notansweredquestions')}}">Not Answered</a></li>
                        <li><a href="{{route('adminfavquestions')}}">Admin's Favorite</a></li>
                    </ul>
                </li>
                <li
                    class="@if(in_array(Request::route()->getName(), ['subjectQuestions', 'topicQuestions',])) current_page_item @endif">
                    <a href="javascript:void(0)">Subjects</a>
                    <ul>
                        @forelse ($subjects as $item)
                        <li>
                            <a href="{{route('subjectQuestions', $item->id)}}">{{$item->subject}}</a>
                            <ul>
                                @forelse ($item->topics as $topic)
                                <li><a href="{{route('topicQuestions', $topic->id)}}">{{$topic->topic}}</a></li>
                                @empty

                                @endforelse
                            </ul>
                        </li>
                        @empty

                        @endforelse

                    </ul>
                </li>
                <li
                    class="@if(in_array(Request::route()->getName(), ['login', 'register', 'profile.show',])) current_page_item @endif">
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
                        <li class="{{Request::route()->getName()=='profile.show' ? 'current_page_item' : ''}}">
                            <a href="{{route('profile.show')}}">My Profile</a>
                        </li>
                        <li><a href="{{route('my-questions')}}">My Questions</a></li>
                        <li><a href="{{route('my-fav-questions')}}">My Favorite Questions</a></li>
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


                <li
                    class="@if(in_array(Request::route()->getName(), ['tcorner', 'thenotes',])) current_page_item @endif">
                    <a href="javascript: void(0)">Notes</a>
                    <ul>
                        <li class="{{Request::route()->getName()=='tcorner' ? 'current_page_item' : ''}}">
                            <a href="{{route('tcorner')}}">Today's Corner</a>
                        </li>
                        <li class="{{Request::route()->getName()=='dailymcq.list' ? 'current_page_item' : ''}}">
                            <a href="{{route('dailymcq.list')}}">Daily MCQ</a>
                        </li>
                        <li class="{{Request::route()->getName()=='thenotes' ? 'current_page_item' : ''}}">
                            <a href="{{route('thenotes')}}">Notes</a>
                        </li>
                        <li class="{{Request::route()->getName()=='videos.list' ? 'current_page_item' : ''}}">
                            <a href="{{route('videos.list')}}">Videos</a>
                        </li>
                    </ul>
                </li>

                <li class="current_page_item">
                    <a href="https://blog.neetjeebank.com" target="_blank">Blog</a>
                </li>

            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->