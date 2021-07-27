@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')
<div class="login-page">
    <div class="content-order animatedParent">
        <div class="row">
            <div class="col-md-12 animated bounceInRight" >
                <div  class="page-title" style="margin-bottom: 40px">
                    <div class="main">
                        <h2 class="title-page" >{{ __('Login') }}</h2>
                        <div class="theme-bar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 animated bounceInRight">
                <div class="login-bg animatedParent">
                    <form method="POST" action="{{ url(request()->segment(1)=='login'?'/customer/login':request()->segment(1).'/login') }}" style="float: right">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('E-Mail Address') }} </label>
                            <input type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email') <span>{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" name="password" required autocomplete="current-password">
                            @error('password') <span>{{$message}}</span> @enderror
                        </div>
                        <!--                        <div class="form-group checkbox">-->
                        <!--                            <input type="checkbox" ><label>Remember Me</label>-->
                        <!--                        </div>-->
                        <div class="form-group text-right">
                            <button> {{ __('Login') }}</button>
                        </div>
                        <div  class="text-center create clr-wt pd-10">Dont have account? <a class="clr-wt" href="{{ url(request()->segment(1)=='login'?'/register':request()->segment(1).'/register') }}">Register</a></div>
                        <div  class="text-center create clr-wt pd-10">Just wanna participate in a poll? <a class="clr-wt" href="sign-up.html">poll Participation</a></div>
                        @if (Route::has('password.request'))
                        <div  class="text-center create clr-wt pd-10">{{ __('Forgot Your Password?') }} <a class="clr-wt" href="{{ route('password.request') }}">{{ __('Click Here') }}</a></div>
                        @endif


                    </form>
                </div>
            </div>
            <div class="col-md-6 images animated bounceInLeft">
                <img src="{{asset('assets/images/login.svg')}}" alt="image">
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_css')
    <style>
        .images img{
            float: left;
        }
        .title-page{
            font-weight: 600;
        }
        .page-title{
            width: 17%;

        }
        .page-title .main{
            float: right;
            margin-bottom: 40px;
        }
        .theme-bar{
            width: 60%;
            height: 4px;
            background-color: #7158F4;
        }
    </style>
@endsection
