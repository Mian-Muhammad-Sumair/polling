@extends('layouts.app')
@section('title')
    Create Poll
@endsection

@section('content')
    <div class="container content-order ">
        <div class="row login-bg ">

            <form method="post" action="{{ url('/poll_participate') }}">
                @csrf
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-12 main">
                            <h2 class="title-page">Poll :{{$poll['name']}}</h2>
                            <div class="theme-bar" style="margin-bottom: 20px;"></div>
                            <div  class="heading"  style="margin-bottom: 30px;">
                                <p>Poll offered by {{$creator_name}} from {{$poll['start_date']}} to {{$poll['end_date']}}</p>
                            </div>

                        </div>

                        @foreach ($poll['pollIdentifierQuestions'] as $index => $question)
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{$question['identifier_question']}}</label>
                                    <input type="hidden" name="answer[{{$index+1}}][question]" value="{{$question['id']}}" >
                                    <input type="text" name="answer[{{$index+1}}][answer]" value="{{old('answer.'.($index+1).'.answer')}}"  placeholder="{{$question['identifier_question']}}">
                                    @error('answer.'.($index+1)) <span class="error_msg">{{$message}}</span> @enderror
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <input type="hidden" name="poll_code" value="{{$pollCode}}" >
                            <input type="submit" class="custom-btn btn-lg" name="status" value="Submit">
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('extra_css')
    <style>
        .images img {
            float: right;
        }
        .error_msg{
            color:red;
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
        .btn-lg{
            padding: 25px 120px !important;
            color: white !important;
            font-weight: 600 !important;
            margin-top: 40px !important;
            font-size: 24px !important;
            background-color: #7158f4 !important;

        }
        .add_button:hover, .add_button:focus {
            color: #fff !important;
            text-decoration: none;
        }
        .custom-btn{
            text-transform: inherit;
        }
        .login-bg form .second-part  input{
            color: #000000;
        }
        .second-part .custom-btn{
            margin-top: 15px;
        }
        .bottom{
            margin-top: 30px;
        }
    </style>
@endsection
