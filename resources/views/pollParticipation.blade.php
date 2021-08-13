@extends('layouts.app')
@section('title')
    Poll Participation
@endsection
@section('content')
    <div class="container  participation-section  content-order animatedParent" >
        <div class="row">
            <div class="col-md-6 col-sm-7  animated bounceInRight">
                <div class="login-bg login-form participation-form register-bg animatedParent">
                    <div class="main">
                        <h2 class="title-page">Poll Participation</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <form  action="{{ url('/') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Enter Polling key </label>
                            <input type="text" name="polling_key"  value="{{ old('polling_key') }}" >
                            <input type="hidden" name="user_id"  value="{{ auth()->id() }}" >
                            @error('polling_key') <span class="error_msg">{{$message}}</span> @enderror

                        </div>
                        <div class="form-group text-right">
                            <button>Participate a poll</button>
                        </div>
                        <div  class="text-center create clr-wt pd-10">Already have an account? <a class="clr-wt" href="{{url('/login')}}"><strong>Login</strong></a></div>
                        </form>
                </div>
            </div>
            <div class="col-md-6 col-sm-5 participation-img login-img image animated bounceInLeft">
                <img src="{{asset('assets/images/login.svg')}}" alt="image">
            </div>
        </div>
    </div>
@endsection
@section('extra_css')
    <style>
        .title-page{
            font-weight: 600;
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


        .page-title .main{
            float: right;
            margin-bottom: 40px;
        }

    </style>
@endsection
