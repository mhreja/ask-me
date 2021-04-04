@extends('frontend.layouts.app')

@section('title', 'Login')

@section('head')
{!! htmlScriptTagJsApi() !!}
@endsection


@section('content')

<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Login</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Login</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-6">
            <div class="page-content">
                <h2>Login</h2>
                <div class="form-style form-style-3">
                    <div style="color:red; padding: 0 0 10px 0  ">
                        <x-jet-validation-errors class="mb-4" />
                    </div>

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif


                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class=" form-inputs">
                            <p class="login-text">
                                <input type="text" name="username" value="{{old('username')}}" placeholder="Username">
                                <i class="icon-user"></i>
                            </p>
                            <p class="login-password">
                                <input type="password" name="password" placeholder="********">
                                <i class="icon-lock"></i>
                                <a href="{{ route('password.request') }}">Forget</a>
                            </p>
                        </div>
                        <div class="rememberme">
                            <label><input type="checkbox" checked="checked" name="remember"> Remember Me</label>
                        </div>
                        <p class="form-submit login-submit">
                            <input type="submit" value="Log in" class="button color small login-submit">
                        </p>
                    </form>
                </div>
            </div><!-- End page-content -->
        </div><!-- End col-md-6 -->


        <div class="col-md-6">
            <div class="page-content">
                <h2>Register Now</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet
                    suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate
                    posuere nisl quis consequat.</p>
                <a class="button small color" href="{{route('register')}}">Create an account</a>
            </div><!-- End page-content -->
        </div><!-- End col-md-6 -->
    </div>
</section><!-- End container -->

@endsection

@section('scripts')

@endsection