@extends('layouts.app')
@section('title')
    Assign Permission
@endsection

@section('content')

    <div class="container content-order ">
        <div class="row login-bg ">
            <form method="POST" action="{{ url('admin/assign_permission') }}">
                @csrf
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-12 main">
                            <h2 class="title-page">Assign Permissions to <strong>{{$role['name']}}</strong></h2>
                            <input type="hidden" name="role_id" value="{{$role['id']}}">
                            <div class="theme-bar"></div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class=" account-details ">
                                <div class="form-group checkbox">
                                    <label>Permissions</label>
                                    @foreach($permissions as $index=>$permission)
                                        <div class="col-md-3 col-sm-3 ">
                                            <input type="checkbox" name="permission[{{$index+1}}]" {{in_array($permission['name'],$role_permissions)?"Checked":''}}
                                                   value="{{$permission['id']}}"   id="{{$permission['name']}}">
                                            <label class="checkbox-main" for="{{$permission['name']}}">
                                                <span class="first"></span>
                                                <span>{{$permission['name']}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('permission') <span class="error_msg">{{$message}}</span> @enderror
                                    @error('role_id') <span class="error_msg">{{$message}}</span> @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <input type="submit" class="custom-btn btn-lg" name="status" value="Assign">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('extra_js')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script type="text/javascript">
        $(document).ready(function() {
            var x = 1; //Initial field counter is 1
            var z = 1; //Initial field counter is 1
            var maxField = 5; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var addQuestion = $('.add_question'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var wrap = $('.field_wrap'); //Input field wrapper
            var fieldHTML = '<div> <input type="text" name="poll_option[]" value=""><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
            var fieldQuestionHTML = '<div> <input type="text" name="identifier_question[]" value=""><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html


            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $(addQuestion).click(function() {
                //Check maximum number of input fields
                if (z < maxField) {
                    z++; //Increment field counter
                    $(wrap).append(fieldQuestionHTML); //Add field html
                }
            });
            $(wrap).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
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
            value = makekey();
            var key = document.getElementById('key').value = value;

        }
    </script>
@endsection
@section('extra_css')
    <style>
        .images img {
            float: right;
        }

        .error_msg {
            color: red !important;
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

        /* .container {
                width: 80%;
            } */
        .form-contact form,
        .login-bg form,
        .sign-up form {
            padding: 20px 0px;
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

        .form-contact form,
        .login-bg form {
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
            font-size: 13px;
        }
        .checkbox-main{
            padding: 15px 15px;
        }

        .login-bg form .second-part label,
        .select-styled,
        .login-bg form .account-details label {
            color: #000000 !important;
        }

        .btn-lg {
            padding: 15px !important;
            color: white !important;
            font-weight: 600 !important;
            margin-top: 30px !important;
            font-size: 18px !important;
            background-color: #0044e4 !important;

        }
        strong{
        color: #0044e4 !important;
        }

        .add_button:hover, .add_button:focus,
        .add_question:hover, .add_question:focus{
            color: #fff !important;
            text-decoration: none;
        }

        .custom-btn {
            text-transform: inherit;
        }

        .login-bg form .second-part input {
            color: #000000;
        }

        .second-part .custom-btn {
            margin-top: 15px;
        }


        @media screen and (max-width: 767px) {
            .content-order .register-img img {

                margin-bottom: 30px;
                margin-top: 20px !important;
            }
        }
    </style>
@endsection
