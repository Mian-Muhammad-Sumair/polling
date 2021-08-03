@extends('layouts.app')
@section('title')
    Create Poll
@endsection

@section('content')

    <div class="container content-order ">
        <div class="row login-bg ">
            <form method="POST" action="{{ url(request()->segment(1)=='register_poll'?'/register_poll':request()->segment(1).'/register_poll') }}" >
                @csrf
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-8 col-sm-8">
                        <div class="col-md-12 main">
                            <h2 class="title-page">Create poll</h2>
                            <div class="theme-bar"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Poll Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" >
                                @error('name') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>Poll Open Window</label>
                                <div class="text" style="font-size:40px;">
                                    <input type="date" name="start_date"  style="width: 40%" placeholder="From" value="{{ old('start_date') }}"> -
                                    <input type="date" name="end_date"  style="width: 40%" placeholder="To"  value="{{ old('end_date') }}">
                                    @error('start_date') <span class="error_msg">{{$message}}</span> @enderror
                                    @error('end_date') <span class="error_msg">{{$message}}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Poll Info</label>
                                <input type="text" name="info" placeholder=""  value="{{ old('info') }}">
                                @error('info') <span class="error_msg">{{$message}}</span> @enderror

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Poll question</label>
                                <input type="text" name="question"  value="{{ old('question') }}">
                                @error('question') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 field_wrapper">
                            <div class="form-group">
                                <label>Poll Option</label>
                                <input type="text" name="option[]" value="">
                                @error('option') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right float-right">
                                <a  href="javascript:void(0);" title="Add field" class="custom-btn add_button">Add option +</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 register-img images">
                        <img class="" src="{{asset('assets/images/register_poll.png')}}" alt="image">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 second-part">
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group ">
                            <label>Poll category</label>
                            <select class="" name="category" value="{{ old('category') }}">
                                <option class="Eg. Web Desig">Eg. Web Design</option>
                            </select>
                            @error('category') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 ">
                        <div class="form-group">
                            <label>Poll visibility <span>*</span></label>
                            <select name="visibility" value="{{ old('visibility') }}">
                                <option value="">Select</option>
                                <option value="Private">Private</option>
                            </select>
                            @error('visibility') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-10 col-sm-10 account-details ">
                        <div class="form-group checkbox">
                            <label>Poll category</label>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Allow Multiple Votes" id="Allow Multiple Votes"><label
                                    class="checkbox-main" for="Allow Multiple Votes" ><span class="first"></span><span>Allow Multiple Votes</span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Login to Vote" id="Login to Vote"><label
                                    class="checkbox-main" for="Login to Vote"><span class="first"></span><span>Login to Vote</span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Add Comments " id="Add Comments "><label
                                    class="checkbox-main" for="Add Comments "><span class="first"></span><span>Add Comments </span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Allow Multiple Votes" id="Allow Multiple Votes"><label
                                    class="checkbox-main" for="Allow Multiple Votes"><span class="first"></span><span>Allow Multiple Votes</span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Allow Multiple Votes" id="Allow Multiple Votes"><label
                                    class="checkbox-main" for="Allow Multiple Votes"><span class="first"></span><span>Allow Multiple Votes</span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="Login to Vote" id="Login to Vote"><label
                                    class="checkbox-main" for="Login to Vote"><span class="first"></span><span>Login to Vote</span></label>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <input type="checkbox" name="poll_cat" value="save as draft" id="save as draft"><label
                                    class="checkbox-main" for="save as draft"><span class="first"></span><span>save as draft</span></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 bottom">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                     <div class="custom-btn btn-lg">Lock poll</div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4  second-part">
                        <div class="form-group">
                            <label>Generate polling key</label>
                            <input type="text" id="key" name="key" value="{{ old('key') }}" >
                            @error('key') <span class="error_msg">{{$message}}</span> @enderror
                            <div onclick="getkey()" class="custom-btn ">Generate</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <input type="submit" class="custom-btn btn-lg" value="Publish poll">
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection

@section('extra_js')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script type="text/javascript">
        $(document).ready(function(){
            var x = 1; //Initial field counter is 1
            var maxField = 5; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div> <input type="text" name="option[]" value=""><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html


            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
        function makekey() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 20; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
        function getkey() {
            var value = "";
            value=makekey();
            var key=document.getElementById('key').value=value;

        }
    </script>
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
