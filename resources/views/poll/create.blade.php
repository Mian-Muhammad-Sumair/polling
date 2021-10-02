@extends('layouts.app')
@section('title')
Create Poll
@endsection

@section('content')

<div class="container content-order ">
    <div class="row login-bg ">
        <form method="POST" action="{{ url('poll') }}">
            @csrf
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="col-md-7 col-sm-8">
                    <div class="col-md-12 main">
                        <h2 class="title-page">Create poll</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Poll name</label>
                            <input type="text" name="name" value="{{ old('name') }}">
                            @error('name') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group ">
                            <label>Poll open window</label>
                            <div class="text" style="font-size:30px;">
                                <input type="date" name="start_date" style="width: 43%" placeholder="From" value="{{ old('start_date') }}"> -
                                <input type="date" name="end_date" style="width: 43%" placeholder="To" value="{{ old('end_date') }}">
                                @error('start_date') <span class="error_msg">{{$message}}</span> @enderror
                                @error('end_date') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Poll info</label>
                            <input type="text" name="info" placeholder="" value="{{ old('info') }}">
                            @error('info') <span class="error_msg">{{$message}}</span> @enderror

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Poll question</label>
                            <textarea class="form-control" id="summary-ckeditor"  name="question">{{old('question')}}</textarea>
                            @error('question') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                    {{-- {{dd($errors)}}--}}
                    <div class="col-md-12 field_wrapper">
                        <div class="form-group">
                            <label>Poll option</label>
                            @if(old('poll_option'))
                            @foreach(old('poll_option') as $index=>$option)
                            <input type="text" name="poll_option[]" value="{{$option}}">
                            @error('poll_option.'.$index) <span class="error_msg">{{$message}}</span> @enderror
                            @endforeach
                            @else
                            <input type="text" name="poll_option[]" value="">
                            @endif
                            @error('poll_option') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-right float-right">
                            <a href="javascript:void(0);" title="Add field" class="custom-btn add_button">Add option +</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-5 col-sm-12 register-img images">
                    <img class="" src="{{asset('assets/images/register_poll.png?v=1')}}" alt="image">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 second-part">
                <div class="col-md-12 field_wrap">
                    <div class="form-group">
                        <label>Poll identifier questions</label>
                        @if(old('identifier_question'))
                        @foreach(old('identifier_question') as $index=>$option)
                        <input type="text" name="identifier_question[]" value="{{$option}}">
                        @error('identifier_question.'.$index) <span class="error_msg">{{$message}}</span> @enderror
                        @endforeach
                        @else
                        <input type="text" name="identifier_question[]" value="">
                        @endif
                        @error('identifier_question') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-right float-right">
                        <a href="javascript:void(0);" title="Add field" class="custom-btn add_question">Add more question +</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group ">
                        <label>Poll category</label>
                        <div class="select-dropdown">
                            <select name="category">
                                <option class="option-item" disabled selected>
                                    Select
                                </option>

                                @foreach($categories as $category)
                                <option class="option-item" {{$category==old('category')?'selected':''}} value="{{$category}}">
                                    {{$category}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 ">
                    <div class="form-group">
                        <label>Poll visibility <span>*</span></label>
                        <!-- <select class="poll-select-list" name="visibility" selected="{{ old('visibility') }}">
                            <option value="">Select</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select> -->
                        <div class="select-dropdown">
                            <select name="visibility">
                                <option class="option-item" value="private" {{'private'==old('visibility')?'selected':''}}>
                                    Private
                                </option>
                                <option class="option-item" value="public" {{'public'==old('visibility')?'selected':''}}>
                                    Public
                                </option>
                            </select>
                        </div>

                        @error('visibility') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class=" account-details ">
                    <div class="form-group checkbox">
                        <label>Poll option type</label>
                        @foreach(config('poll_option_types') as $option_type=>$option_type_title)
                        <div class="col-md-3 col-sm-3 ">
                            <input type="checkbox" name="option_type[]" value="{{$option_type}}" @if(old('option_type') && in_array($option_type,old('option_type')) ) checked @else @endif id="{{$option_type}}">
                            <label class="checkbox-main" for="{{$option_type}}">
                                <span class="first"></span>
                                <span>{{$option_type_title}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 bottom">
                <div class="col-md-4 col-sm-4 col-lg-4">
                    <input type="submit" class="custom-btn btn-lg" name="status" value="Lock Poll">
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  second-part">
                    <div class="form-group">
                        <label>Generate polling key</label>
                        <input type="text" id="key" name="key" value="{{ old('key') }}">
                        <div class="Generate-polling-key-radio">
                            <input type="checkbox" id="key_type" class="largerCheckbox"  {{old('key')==1?"checked":''}}  name="key_type" value="1">
                            <label for="key_type"> Multiple polling keys</label>

                        </div>

                        @error('key') <span class="error_msg">{{$message}}</span> @enderror
                        <div onclick="getkey()" class="custom-btn ">Generate</div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4">
                    <input type="submit" class="custom-btn btn-lg" name="status" value="Published">
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
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'poll_option', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

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

    .bottom {
        margin-top: 30px;
    }

    @media screen and (max-width: 767px) {
        .content-order .register-img img {

            margin-bottom: 30px;
            margin-top: 20px !important;
        }
    }
</style>
@endsection
