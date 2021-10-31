@extends('layouts.app')
@section('title')
Create Poll
@endsection

@section('content')

<div class="container content-order ">
    <div class="row login-bg ">
        <form method="POST" action="{{ url('poll') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="col-md-7 col-sm-8">
                    <div class="col-md-12 main">
                        <h2 class="title-page">Create poll</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Poll name</label>

                            <textarea class="form-control" id="name"  name="name">{{ old('name') }}</textarea>
                            @error('name') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
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
                </div>
                <div class="col-md-5 col-sm-12 register-img images">
                    <img class="" src="{{asset('assets/images/register_poll.png?v=1')}}" alt="image">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 second-part">
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
                        <textarea class="form-control" id="question_editor"  name="question">{{ old('question')}}</textarea>
                        @error('question') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Question Video</label>
                        <input type="file"  id="question_video" name="question_video" >
                        @error('question_video') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12 field_wrapper">
                    <div class="form-group">
                        <label>Poll option</label>
                        @if(old('poll_option'))
                            @php
                                $id=['poll_option_one','poll_option_two','poll_option_three','poll_option_four','poll_option_five'];
                                $totalOption=count(old('poll_option'));
                            @endphp
                            @foreach(old('poll_option') as $index=>$option)
                                <div class="form-group">
                                 <textarea class="form-control" id="{{$id[$index]}}"  name="poll_option[{{$index}}]">{{$option}}</textarea>
                                </div>
                                @error('poll_option.'.$index.'option') <span class="error_msg">{{$message}}</span> @enderror
                                <div class="form-group">
                                    <label>Option video</label>
                                    <input type="file"  id=""  name="video_{{$index}}" >
                                    @error('poll_option.'.$index.'option') <span class="error_msg">{{$message}}</span> @enderror
                                </div>
                            @endforeach
                                <input type="hidden"  id="total_Options" name="total_Options" value="{{$totalOption}}">
                        @else
                            <div class="form-group">
                             <textarea class="form-control" id="poll_option_one"  name="poll_option[0]"></textarea>
                             </div>
                            <div class="form-group">
                                <label>Option video</label>
                                <input type="file"  id=""  name="video_0" >
                            </div>
                            <input type="hidden"  id="total_Options" name="total_Options" value="0">

                        @endif

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-right float-right">
                        <a href="javascript:void(0);" title="Add field" class="custom-btn add_button">Add option +</a>
                    </div>
                </div>
                <div class="col-md-12 field_wrap">
                    <div class="form-group">
                        <label>Poll identifier questions</label>
                        @if(old('identifier_question'))
                        @foreach(old('identifier_question') as $index=>$option)
                         <div class="col-md-10 ">
                            <input type="text" name="identifier_question[{{$index}}][question]" value="{{$option['question']}}">
                             @error('identifier_question.'.$index.'.question') <span class="error_msg">{{$message}}</span> @enderror
                         </div>
                         <div class="col-md-2">
                             <div class="Generate-polling-key-radio">
                                 <input type="checkbox" id="key_type{{$index}}" class="largerCheckbox" {{Isset($option['required'])&&$option['required']==1?"checked":''}}  name="identifier_question[{{$index}}][required]" value="1">
                                 <label for="key_type{{$index}}"> Required</label>
                             </div>
                         </div>

                        @endforeach
                            <input type="hidden" id="total_identifier_question" value="{{count(old('identifier_question'))}}">
                        @else
                        <div class="col-md-10 ">
                            <input type="hidden" id="total_identifier_question" value="1">
                            <input type="text" name="identifier_question[0][question]" value="">
                            @error('identifier_question') <span class="error_msg">{{$message}}</span> @enderror
                        </div>
                            <div class="col-md-2">
                                <div class="Generate-polling-key-radio">
                                    <input type="checkbox" id="key_type0" class="largerCheckbox"  name="identifier_question[0][required]" value="1">
                                    <label for="key_type0"> Required</label>
                                </div>
                            </div>
                        @endif
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
                <div class="col-md-4 col-sm-4 col-lg-4">
                    <a style="width: 100%;text-align: center"  data-toggle="modal" data-target="#demoModal" onclick="generateKey()" class="custom-btn  btn-lg ">Generate Poll Key</a>
                    @error('key') <span class="error_msg">{{$message}}</span> @enderror
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4">
                    <input type="submit" class="custom-btn btn-lg" name="status" value="Published">
                </div>

            </div>
            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="demoModalLabel">Sellect Keys</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @if(old('key'))
                            <div class="modal-body ">
                            @foreach(old('key') as $index=>$key)
                                <div class="col-lg-12">
                                    <div class="col-lg-10">
                                        <input type="text" id="key" name="key[{{$index}}][key]" value="{{$key['key']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="Generate-polling-key-radio" style="margin-top: 12px">
                                            <input type="checkbox" id="key_type0" class="largerCheckbox" {{$key['required']?"checked":''}}  name="key[{{$index}}][required]" value="1">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <input type="hidden" id="total_keys" name="total_keys" value="{{(count(old('key')))}}">
                            </div>
                        @else
                            <div class="modal-body key_data">
                                <input type="hidden" id="total_keys" name="total_keys" value="0">
                                @error('key.key') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        @endif

                        <div class="modal-footer" style="color: white">
                            <a href="#" class="  custom-btn" data-dismiss="modal">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra_js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var x = 1; //Initial field counter is 1
        var z = document.getElementById('total_identifier_question').value; //Initial field counter is 1
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var addQuestion = $('.add_question'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var wrap = $('.field_wrap'); //Input field wrapper
        var total_Options= document.getElementById('total_Options').value;
        x = parseInt(total_Options, 10);

        var id ='';
        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {

                var test = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                for (var i = 0; i < 20; i++)
                    id += test.charAt(Math.floor(Math.random() * test.length));


                var fieldHTML = '<div class="option">' +
                    ' <div class="form-group"><textarea class="form-control" id="'+ id +'"  name="poll_option['+x+']" ></textarea></div>' +
                    ' <div class="form-group">' +
                    '<label>Option video</label>' +
                    '<input type="file"  id=""  name="video_'+x+'" >\n' +
                    ' </div>' +
                    '<a href="javascript:void(0);" class="remove_button">Remove</a>' +
                    '</div>'; //New input field html
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
                $(document).load(
                    CKEDITOR.replace(id  , {
                    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                }));
            }
        });
        $(addQuestion).click(function() {
            var fieldQuestionHTML = '<div class="question"><div class="col-lg-8"> <input type="text" name="identifier_question['+z+'][question]" value=""></div> ' +
                {{--'   @error("identifier_question."+z+".question") <span class="error_msg">{{$message}}</span> @enderror' +--}}
                '<div class="col-md-2">' +
                ' <div class="Generate-polling-key-radio">' +
                '<input type="checkbox" id="key_type['+z+']" class="largerCheckbox" name="identifier_question['+z+'][required]" value="1">' +
                '<label for="key_type['+z+']"> Required</label>\n' +
                '                             </div>\n' +
                '                         </div>' +
                '<div class="col-lg-2"><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a></div>' +
                '</div>'; //New input field html
            //Check maximum number of input fields
            if (z < maxField) {
                z++; //Increment field counter
                $(wrap).append(fieldQuestionHTML); //Add field html
            }
        });
        $(wrap).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest(".question").remove(); //Remove field html
            z--; //Decrement field counter
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.option').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    function makekey() {
        var text = "";
        var possible = "0123456789";
        for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function getkey(id) {
        var value = "";
        value = makekey();
        var key = document.getElementById(id).value = value;

    }
    function generateKey() {
        var totalKeys =  document.getElementById('total_keys').value;
        var max=5;
        var total=   parseInt(totalKeys, 10) - parseInt(max, 10);
        if(total<0){
            var keymode=$('.key_data');
            for (var i = 1 ; i < 6; i++){
                value = makekey();
                var Keyhtml = '<div class="col-lg-12"><div class="col-lg-10"><input type="text" id="key'+i+'" name="key['+i+'][key]" value="'+ value +'"></div><div class="col-lg-2">\n' +
                    '<div class="Generate-polling-key-radio" style="margin-top: 12px"><input type="checkbox" id="key_type0" class="largerCheckbox" checked name="key['+i+'][required]" value="1"></div></div></div>';
                 $(keymode).append(Keyhtml); //Add field html
                document.getElementById("total_keys").value=i;
            }

        }

    }
</script>
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'question_editor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'poll_option_one', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'poll_option_two', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace( 'poll_option_three', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'poll_option_four', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'name', {
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
    .field_wrap .Generate-polling-key-radio{
        margin-top: 10px;
    }
    .remove_button{
        margin-top:15px;
    }

</style>
<link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous">
@endsection
