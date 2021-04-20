@extends('frontend.layouts.app')

@section('title', 'Register')

@section('head')
{!! htmlScriptTagJsApi() !!}
<style>
    .row div {
        margin-bottom: 10px;
    }

    label span {
        color: red;
    }
</style>
@endsection


@section('content')

<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Register</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Register</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="page-content">
        <h2>Register</h2>
        <div class="form-style form-style-3">
            <div style="color:red; padding: 0 0 10px 0  ">
                <x-jet-validation-errors class="mb-4" />
            </div>

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif


            <form method="POST" action="{{route('register')}}">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label>Resgister As <span>*</span></label>
                        <select name="register_as">
                            <option value="1" {{old('roll') == '1' ? 'selected' : ''}}>Student</option>
                            <option value="2" {{old('roll') == '2' ? 'selected' : ''}}>Teacher</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Interested Exam</label>
                        <input type="text" name="interested_exam" value="{{old('interested_exam')}}"
                            placeholder="Exam Name">
                    </div>
                    <div class="col-md-4">
                        <label>Class</label>
                        <input type="text" name="class" value="{{old('class')}}" placeholder="Class">
                    </div>
                    <div class="col-md-4">
                        <label>Full Name <span>*</span></label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="John Doe">
                    </div>
                    <div class="col-md-4">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="{{old('dob')}}">
                    </div>
                    <div class="col-md-4">
                        <label>City</label>
                        <input type="text" name="city" value="{{old('city')}}" placeholder="Agra">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Email <span>*</span></label>
                        <input type="text" name="email" value="{{old('email')}}" placeholder="john@mail.com">
                    </div>
                    <div class="col-md-4">
                        <label>Mobile <span>*</span></label>
                        <input type="text" name="mobile" value="{{old('mobile')}}" maxlength="10"
                            placeholder="9732***000">
                    </div>
                    <div class="col-md-4">
                        <label>Username <span>*</span></label>
                        <input type="text" name="username" value="{{old('username')}}" placeholder="john">
                    </div>
                    <div class="col-md-6">
                        <label>Password <span>*</span></label>
                        <input type="password" name="password" placeholder="*********">
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password <span>*</span></label>
                        <input type="password" name="password_confirmation" placeholder="*********">
                    </div>
                </div>

                <button type="submit" class="button color small login-submit">Register</button>
            </form>
        </div>
    </div>

</section><!-- End container -->

@endsection

@section('scripts')

@endsection