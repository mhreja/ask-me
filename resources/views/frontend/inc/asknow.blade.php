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
                    <form class="form-style form-style-2">
                        <p>
                            <textarea rows="4" id="question_title"
                                onfocus="if(this.value=='Ask any question and you be sure find your answer ?')this.value='';"
                                onblur="if(this.value=='')this.value='Ask any question and you be sure find your answer ?';">Ask any question and you be sure find your answer ?</textarea>
                            <i class="icon-pencil"></i>
                            <span class="color button small publish-question">Ask Now</span>
                        </p>
                    </form>
                </div>
            </div><!-- End row -->
        </div><!-- End box_icon -->
    </div><!-- End container -->
</div><!-- End section-warp -->