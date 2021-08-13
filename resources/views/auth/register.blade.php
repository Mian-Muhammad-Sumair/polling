@extends('layouts.app')
@section('title')
    Register
@endsection
@section('content')
<div class=" content-order animatedParent">
    <div class="row">
        <div class="col-md-6 images animated bounceInLeft ">
            <img class="" src="{{asset('assets/images/register.png')}}" alt="image">
        </div>
        <div class="col-md-6 animated bounceInRight">
            <div class="login-bg register-bg animatedParent">
                <div class="main">
                    <h2 class="title-page" >{{ __('Register') }}</h2>
                    <div class="theme-bar"></div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="user_type" value="{{ request()->segment(1)=='register'?'customer':request()->segment(1)}}">
                    <div class="form-group">
                        <label>{{ __('Name') }} </label>
                        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')<span>{{ $message }}</span>@enderror
                        @error('user_type')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('E-Mail Address') }} </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Password') }} </label>
                        <input type="password" name="password" required autocomplete="new-password">
                        @error('password')<span class="error_msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit">{{ __('Register') }}</button>
                    </div>
                    <div  class="text-center create clr-wt pd-10">Already have an account? <a class="clr-wt" href="{{url(request()->segment(1)=='register'?'/login':request()->segment(1).'/login')}}">Login</a></div>
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
        .login-bg{
            padding-left: 50px;
        }
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
            background-color: #7158F4;
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
