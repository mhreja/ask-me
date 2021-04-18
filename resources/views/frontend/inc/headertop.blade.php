<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                <li><a href="{{route('contact')}}"><i class="icon-envelope"></i>Contact</a></li>
                <li><a href="{{route('contact')}}"><i class="icon-headphones"></i>Support</a></li>
                @auth
                <li>
                    <a
                        href="@if(Auth::user()->is_admin == 1){{route('dashboard')}}@else{{route('myprofile.show')}}@endif">
                        <img width="18px" height="18px" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" style="border-radius: 50%; display: inline;">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                @endauth
                @guest
                <li><a href="{{route('login')}}"><i class="icon-user"></i>Login</a></li>
                @endguest
            </ul>
        </nav>
        <div class="header-search">
            <form>
                <input type="text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';"
                    onblur="if(this.value=='')this.value='Search here ...';">
                <button type="submit" class="search-submit"></button>
            </form>
        </div>
    </section><!-- End container -->
</div><!-- End header-top -->