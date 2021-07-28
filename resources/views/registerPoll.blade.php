@extends('layouts.app')
@section('title')
    Create Poll
@endsection
@section('extra_css')
    <style>
        .images img {
            float: right;
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
            background-color: #7158F4;
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
    </style>
@endsection
@section('content')

    <div class="container content-order " >
        <div class="row login-bg ">
            <form >
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-8 col-sm-8">
                            <div class="col-md-12 main">
                                <h2 class="title-page">Create poll</h2>
                                <div class="theme-bar"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Poll Name</label>
                                    <input type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Poll Open Window</label>
                                    <div class="text" style="font-size:40px;">
                                        <input type="text" required style="width: 40%" placeholder="From"> -
                                        <input type="text" required style="width: 40%" placeholder="To">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Poll Info</label>
                                    <input type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Poll question</label>
                                    <input type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Poll Option</label>
                                    <input type="text" required>
                                </div>
                            </div>
                            <div>
                                <div class="form-group text-right">
                                    <button class="btn float-right">Submit</button>
                                </div>
                            </div>

                    </div>
                    <div class="col-md-4 col-sm-4 register-img images">
                        <img class="" src="{{asset('assets/images/register_poll.png')}}" alt="image">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group ">
                            <label>Poll category</label>
                           <select class="">
                               <option class="">Eg. Web Design</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group">

                            <label>Poll visibility <span>*</span></label>
                            <div class="select">
                            <select>
                                <option value="" selected disabled>Select</option>
                                <option value="Private">Private</option>
                            </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-10 col-sm-10 col-lg-10">
                <div class="col-md-2 col-sm-2 col-lg-2">
                </div>
                </div>
            </form>
        </div>
    </div>
@endsection
