@extends('layouts.app')
@section('title')
    Make Payment
@endsection
@section('content')

    <div class="container" >
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="login-bg register-bg ">
                    <form method="POST" action="{{ url("/payment") }}">
                        @csrf

                        <input type="hidden" name="plan" value="{{$plan}}" required>
                        <div class="col-md-12 col-sm-12 main">
                            <h2 class="title-page">Set billing info</h2>
                            <div class="theme-bar"></div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" name="first_name" value="{{old('first_name')}}" required>
                                @error('first_name') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" value="{{old('last_name')}}" required>
                                @error('last_name') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email"   value="{{old('email')}}" required>
                                @error('email') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country"  value="{{old('country')}}"  required>
                                @error('country') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{old('city')}}"  required>
                                @error('city') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text"  name="state" value="{{old('state')}}"   required>
                                @error('state') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 payment_method">
                            <div class="form-group ">
                                <div class="col-md-12 col-sm-12 ">
                                    <h2>Select billing method</h2>
                                </div>
                                <div class="col-md-4 col-sm-4 payment_icon">
                                    <input type="radio" class="radio_item" value="paypal" name="payment_mode" id="radio1">
                                    <label class="label_item" for="radio1">
                                        <div class="img-content">
                                            <img src="{{asset('assets/images/metro-paypal.png')}}">
                                        </div>
                                        <div class="text-center">paypal</div>
                                    </label>
                                </div>
                                <div class="col-md-4 col-sm-4 payment_icon">
                                    <input type="radio" class="radio_item" value="cash" name="payment_mode" id="radio2">
                                    <label class="label_item" for="radio2">
                                        <div class="img-content">
                                            <img src="{{asset('assets/images/ionic-ios-cash.png')}}">
                                        </div>
                                        <div class="text-center">Cash</div>
                                    </label>
                                </div>
                                <div class="col-md-4 col-sm-4 payment_icon">
                                    <input type="radio" class="radio_item" value="apple_pay" name="payment_mode" id="radio3">
                                    <label class="label_item" for="radio3">
                                        <div class="img-content">
                                            <img src="{{asset('assets/images/awesome-apple-pay.png')}}">
                                        </div>
                                        <div class="text-center">Cash App</div>
                                    </label>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Name on card</label>
                                <input type="text" name="name_on_card" value="{{old('name_on_card')}}" required>
                                @error('name_on_card') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Card number</label>
                                <input type="text" name="card_number" value="{{old('card_number')}}"  required>
                                @error('card_number') <span class="error_msg">{{$message}}</span> @enderror

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Expiry date</label>
                                <input type="text"  value="{{old('card_expiry')}}" name="card_expiry" required>
                                @error('card_expiry') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Security code </label>
                                <input type="text"  value="{{old('security_code')}}" name="security_code" required>
                                @error('security_code') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <div class="text-right">
                                    <button class="btn ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 register-img images  " style="padding-top:100px">
                <img class="" src="{{asset('assets/images/billing.png?v=1')}}" alt="image">
            </div>
        </div>
    </div>
@endsection
@section('extra_css')
    <style>
        .title-page {
            font-weight: 800;
        }

        .page-title {
            width: 17%;
        }

        .main {
            margin-bottom: 10px;
        }


        .login-bg form {
            background-color: #F3F3F3;
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

        .login-bg .payment_icon label {
            background-color: white;
            padding: 20px !important;
        }

        .theme-bar {
            width: 20%;
            height: 4px;
            background-color: #0044e4;
            margin-bottom: 20px;
            margin-top: 0px;
        }

        .login-bg form input {
            background-color: white;
            color: #707070;
            font-weight: 600;
        }
        /*
                .register-bg form {
                    width: 90% !important;

                } */

        .login-bg form .form-group {
            margin-bottom: 15px !important;
            margin-top: 0px !important;

        }

        .login-bg h2 {
            color: #707070;
        }

        .form-group .btn {
            background-color: #707070;
            color: white;
        }

        .form-contact form, .login-bg form {
            box-shadow: none;
        }

        .content-order .register-img {
            margin-top: 200px;
        }

        .content-order .register-img img {
            margin-top: 0px;
        }

        .radio_item {
            display: none !important;

        }

        .label_item {
            padding: 10px;
            width: 100%;
            height: 150px;

        }

        .label_item {
            border: 2px solid #707070;
            border-radius: 20px;
        }

        .img-content {
            padding: 10px;
            margin: auto;
            height: 50px;
        }
        .img-content  img {
            height: 50px;

        }


        .payment_method .text-center {
            margin-top: 15px;
            font-size: 20px;
        }

        .radio_item:checked + label {
            border: 3px solid #6C63FF;
        }

        .payment_method label {
            cursor: pointer;
            display: inline-grid !important;
        }

        .payment_method h2 {
            margin-bottom: 40px;
            font-weight: 800;
            font-size: 28px;
        }

        .payment_method {
            padding: 40px 0px;
        }

        @media only screen and (max-width: 1800px) {
            /* .register-bg form, .sign-up form {
                padding: 40px 35px 24px 35px !important;
            } */

            .login-bg {
                padding-left: 0px;
            }
        }

        @media only screen and  (max-width: 1400px) {
            /* .register-bg form, .sign-up form {
                padding: 30px 25px 20px 25px !important;
            } */

            .img-content {
                height: 56px;
            }
        }

        @media only screen and (min-width: 991px) and (max-width: 1200px) {
            /* .register-bg form, .sign-up form {
                padding: 30px 25px 20px 25px !important;
            } */

            .content-order .register-img img {
                max-width: 100%;
            }

            .register-bg form {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 1500px) {
            /* .container {
                width: 90%;
            } */

            .content-order .register-img img {
                max-width: 100%;
            }

            .payment_method .text-center {
                margin-top: 40px;
            }
        }

        @media only screen and (max-width: 1000px) {
            .content-order .register-img img {
                max-width: 100% !important;
                display: block;
                margin: auto;
            }

            .payment_method {
                display: flow-root !important;
            }

            .content-order .register-img {
                margin-top: 100px;

            }
        }

    </style>
@endsection
