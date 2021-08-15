@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')

<div class="container login-container content-order animatedParent">
    <div class="row">
        <div class="col-md-12 col-sm-12  animated bounceInRight">
            <div class="main">
                <h2 class="title-page">{{ __('Login') }}</h2>
                <div class="theme-bar"></div>
            </div>
        </div>
        <div class="col-md-5 col-sm-7  animated bounceInRight">
            <div class="login-bg login-form register-bg animatedParent">

                <form method="POST" action="{{ url(request()->segment(1)=='login'?'/customer/login':request()->segment(1).'/login') }}" style="float: right">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('E-Mail Address') }} </label>
                        <input type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password </label>
                        <input type="password" name="password" required autocomplete="current-password">
                        @error('password') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group text-right">
                        <button>{{ __('Login') }}</button>
                    </div>
                    <div class=" create clr-wt pd-10">Dont have account? <a class="clr-wt" href="{{ url(request()->segment(1)=='login'?'/register':request()->segment(1).'/register') }}"><strong>Register</strong></a></div>
                    <div class=" create clr-wt pd-10">Just wanna participate in a poll? <a class="clr-wt" href="{{ url('/') }}"><strong>Poll Participation</strong></a></div>
                    @if (Route::has('password.request'))
                    <div class=" create clr-wt pd-10">{{ __('Forgot Your Password?') }} <a class="clr-wt" href="{{ route('password.request') }}"><strong>{{ __('Click Here') }}</strong></a></div>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-md-7 col-sm-5 login-img image animated bounceInLeft">
            <img src="{{asset('assets/images/login.svg')}}" alt="image">
        </div>
    </div>
</div>

@endsection
@section('extra_css')
<style>
    .title-page {
        font-weight: 600;
    }

    .main {
        margin-bottom: 10px;
    }


    .page-title .main {
        float: right;
        margin-bottom: 40px;
    }

    /*
    .login-container {
        width: 100%;
    } */
</style>
@endsection
