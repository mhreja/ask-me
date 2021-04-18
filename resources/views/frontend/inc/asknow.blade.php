<div class="section-warp ask-me">
    <div class="container clearfix">
        <div class="box_icon box_warp box_no_border box_no_background" box_border="transparent"
            box_background="transparent" box_color="#FFF">
            <div class="row">
                <div class="col-md-3">
                    <h2>Welcome to Ask me</h2>
                    <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna
                        adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis
                        neque.</p>
                    <div class="clearfix"></div>
                    <a class="color button dark_button medium" href="{{route('about')}}">About Us</a>
                    @guest
                    <a class="color button dark_button medium" href="{{route('register')}}">Join Now</a>
                    @endguest

                    @auth
                    <a class="color button dark_button medium" href="{{route('askquestion.index')}}">
                        Ask Now
                    </a>
                    @endauth
                </div>
                <div class="col-md-9">
                    <form action="{{route('askquestion.miniask')}}" method="POST" class="form-style form-style-2">
                        @csrf
                        <p>
                            <textarea name="question" rows="4"
                                onfocus="if(this.value=='Ask any question you have and get the best answer...')this.value='';"
                                onblur="if(this.value=='')this.value='Ask any question you have and get the best answer...';"
                                placeholder="Ask any question you have and get the best answer..."></textarea>
                            <i class="icon-pencil"></i>
                            <button type="submit" class="color button small publish-question">Ask Now</button>
                        </p>
                    </form>
                </div>
            </div><!-- End row -->
        </div><!-- End box_icon -->
    </div><!-- End container -->
</div><!-- End section-warp -->