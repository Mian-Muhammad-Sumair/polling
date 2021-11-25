@extends('layouts.app')
@section('title')
    {{__('email.Reset Password')}}
@endsection
@section('content')
<div class="container login-container content-order animatedParent">
    <div class="row justify-content-center">
        <div class="col-md-6 animated bounceInRight">
            <div class=" main">
                <h2 class="title-page">Reset Password</h2>
                <div class="theme-bar"></div>
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->

                <div class="card-body">

                    <div class="login-bg login-form register-bg animatedParent">

                        <form>
                            <div class="form-group">
                                <label>{{__('email.E-Mail Address')}}</label>
                                <input type="text" name="email">
                                @error('email') <span>{{$message}}</span> @enderror
                            </div>

                            <div class="form-group text-right">
                                <button  class="custom-btn submit">{{__('email.Send password reset link')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 login-img image animated bounceInLeft">
            <img src="{{asset('assets/images/login.svg')}}" alt="image">
        </div>
    </div>

</div>
@endsection
