@extends('layouts.app')
@section('title')
{{__('user.Update User')}}
@endsection

@section('content')

    <div class="container content-order ">
        <div class="row login-bg ">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="col-md-6 col-sm-7">
                    <div class="col-md-12 main">
                        <h2 class="title-page">{{__('user.Update User')}}</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <form method="post" action="{{ url("/user/update") }}">
                        @csrf
                        @method('put')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.User name')}}</label>
                                <input type="text" name="name" value="{{old('name') == '' ?$user->name:old('name') }}">
                                @error('name') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.Email')}}</label>
                                <input type="text" name="email"
                                       value="{{old('email') == '' ?$user->email:old('email') }}">
                                @error('email') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.About')}}</label>
                                <input type="text" name="about"
                                       value="{{old('about') == '' ?$user->about:old('about') }}">
                                @error('about') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <input type="submit" class="custom-btn-update " name="status" value="{{__('user.Update')}}">
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-5">
                    <div class="col-md-12 main">
                        <h2 class="title-page">{{__('user.Update Password')}}</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <form method="post" action="{{ url("/user/update/password") }}">
                        @csrf
                        @method('put')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.Old Password')}}</label>
                                <input type="password" name="old_password" value="">
                                @error('old_password') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.New Password')}}</label>
                                <input type="password" name="new_password"
                                       value="">
                                @error('new_password') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('user.Conform Password')}}</label>
                                <input type="password" name="confirm_password">
                                @error('confirm_password') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <input type="submit" class="custom-btn-update " name="status" value="{{__('user.Change Password')}}">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script type="text/javascript">

    </script>
@endsection
@section('extra_css')
    <style>
        .images img {
            float: right;
        }

        .error_msg {
            color: red;
        }


        .title-page {
            font-weight: 800;
        }

        .page-title {
            width: 17%;
        }


        .main {
            margin-bottom: 10px;
        }

        .container {
            width: 80%;
        }

        .login-bg form {
            background-color: white;
            border-color: #707070;
            color: #707070;
            margin: auto;

        }

        .login-bg form .form-group:last-child {
            text-align: left;
        }

        .login-bg form label {
            color: #707070;
            font-weight: 600;
        }

        .theme-bar {
            width: 20%;
            height: 4px;
            background-color: #0044e4;
            margin-bottom: 40px;
            margin-top: 0px;
        }

        .login-bg form input {
            background-color: #F6F6F6;
            color: #707070;
            font-weight: 600;
        }

        .register-bg form {
            width: 90% !important;

        }

        .login-bg form .form-group {
            margin-bottom: 25px !important;
            margin-top: 0px !important;

        }

        .form-group .btn {
            background-color: #707070;
            color: white;
        }

        .form-contact form, .login-bg form {
            box-shadow: none;
        }

        .content-order .register-img img {
            margin-top: 200px;
        }

        .select-styled {
            display: block;
            margin-left: 15px;
        }

        form .select {
            border-radius: 8px;
            background: #f6f6f6;
        }

        .account-details {
            margin-top: 15px;
        }

        .content-order .first {
            margin-bottom: 0px;
        }

        .checkbox-main {
            border-radius: 15px;
            background: #f6f6f6;
            padding: 25px 15px;
            box-shadow: 0px 0px 1px 0px #0000004a;
        }

        .checkbox-main .first {
            background-color: white;
        }

        .account-details .form-group.checkbox span {
            color: #000000;
        }

        .login-bg form .second-part label, .select-styled, .login-bg form .account-details label {
            color: #000000 !important;
        }

        .btn-lg {
            padding: 25px 120px !important;
            color: white !important;
            font-weight: 600 !important;
            margin-top: 40px !important;
            font-size: 24px !important;
            background-color: #0044e4 !important;

        }

        .add_button:hover, .add_button:focus,
        .add_question:hover, .add_question:focus {
            color: #fff !important;
            text-decoration: none;
        }

        .custom-btn-update {
            text-transform: inherit;
            background-color: #0044e4 !important;
            color: white !important;
        }

        .login-bg form .second-part input {
            color: #000000;
        }

        .second-part .custom-btn-update {
            margin-top: 15px;
        }

        .bottom {
            margin-top: 30px;
        }
    </style>
@endsection
