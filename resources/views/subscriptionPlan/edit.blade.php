@extends('layouts.app')
@section('title')
    Edit Plan
@endsection

@section('content')

    <div class="container content-order ">
        <div class="row login-bg ">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 main">
                        <h2 class="title-page">Edit Plan</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <form method="post" action="{{ url("/admin/subscription_plan/$plan->id") }}">
                        @csrf
                        @method('put')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{old('name') == '' ?$plan->name:old('name') }}">
                                @error('name') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Plan Type</label>
                                <div class="select-dropdown">
                                    <select name="plan_type" >
                                        <option class="option-item" disabled selected>
                                            Select
                                        </option>
                                        <option class="option-item" value="Day" {{('Day'==old('plan_type') || 'Day'==$plan->latestSubscriptionPlanValue->plan_type)?'selected':''}}>
                                            Day
                                        </option>
                                        <option class="option-item" value="Week" {{('Week'==old('plan_type') || 'Week'==$plan->latestSubscriptionPlanValue->plan_type)?'selected':''}}>
                                            Week
                                        </option>
                                        <option class="option-item" value="Month"  {{('Month'==old('plan_type')|| 'Month'==$plan->latestSubscriptionPlanValue->plan_type)?'selected':''}}>
                                            Month
                                        </option>
                                        <option class="option-item" value="Year"  {{('Year'==old('plan_type')|| 'Year'==$plan->latestSubscriptionPlanValue->plan_type)?'selected':''}}>
                                            Year
                                        </option>
                                    </select>
                                </div>
{{--                                <input type="text" name="plan_type"--}}
{{--                                       value="{{old('plan_type') == '' ?$plan->latestSubscriptionPlanValue->plan_type:old('plan_type') }}">--}}
                                @error('plan_type') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Plan Value</label>

                                <input type="text" name="plan_value"
                                       value="{{old('plan_value') == '' ?$plan->latestSubscriptionPlanValue->plan_value:old('plan_value') }}">
                                @error('plan_value') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Allow Polls</label>
                                <input type="number" name="allow_poll"
                                       value="{{old('allow_poll') == '' ?$plan->latestSubscriptionPlanValue->allow_poll:old('allow_poll') }}">
                                @error('allow_poll') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="allow_poll"
                                       value="{{old('amount') == '' ?$plan->latestSubscriptionPlanValue->amount:old('amount') }}">
                                @error('amount') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>info</label>
                                <textarea name="info">{{old('info') == '' ?$plan->info:old('info') }}</textarea>
                                @error('info') <span class="error_msg">{{$message}}</span> @enderror
                            </div>
                        </div>
{{--                        <div class="Generate-polling-key-radio">--}}
{{--                            <input type="checkbox" id="key_type" class="largerCheckbox"  {{old('key')==1?"checked":''}}  name="key_type" value="1">--}}
{{--                            <label for="key_type"> Multiple polling keys</label>--}}

{{--                        </div>--}}
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <input type="submit" class="custom-btn-update " name="status" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
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
