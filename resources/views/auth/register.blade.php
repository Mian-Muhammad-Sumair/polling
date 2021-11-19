@extends('layouts.app')
@section('title')
    {{ __('register.Name') }}
@endsection
@section('content')
<div class=" content-order animatedParent container">
    <div class="row">
        <div class="col-md-7 images animated bounceInLeft ">
            <img class="" src="{{asset('assets/images/register.png?v=1')}}" alt="image">
        </div>
        <div class="col-md-5 animated bounceInRight">
            <div class="login-bg register-bg animatedParent">
                <div class="main">
                    <h2 class="title-page" >{{ __('register.Register') }}</h2>
                    <div class="theme-bar"></div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="user_type" value="{{ request()->segment(1)=='register'?'customer':request()->segment(1)}}">
                    <div class="form-group">
                        <label>{{ __('register.Name') }} </label>
                        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')<span class="error_msg">{{ $message }}</span>@enderror
                        @error('user_type')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.E-Mail Address') }} </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.Password') }} </label>
                        <input type="password" name="password" required autocomplete="new-password">
                        @error('password')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit">{{ __('register.Register') }}</button>
                    </div>
                    <div  class="text-center create clr-wt pd-10">{{ __('register.Already have an account?') }} <a class="clr-wt" href="{{url(request()->segment(1)=='register'?'/login':request()->segment(1).'/login')}}">{{ __('register.Login') }}</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_css')
    <style>
        .images img{
            float: right;
        }
        /* .login-bg{
            padding-left: 50px;
        } */
        .title-page{
            font-weight: 600;
        }
        .page-title{
            width: 17%;
        }
        .main{
            margin-bottom: 10px;
        }
        .theme-bar{
            width: 10%;
            height: 4px;
            background-color: #0044e4;
            margin-bottom: 20px;
        }
        .error_msg{
            color: #0a0550;
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }
    </style>
@endsection
