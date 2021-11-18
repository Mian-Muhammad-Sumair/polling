@extends('layouts.app')
@section('title')
    {{__('participation.Poll Participation')}}
@endsection
@section('content')
    <div class="container  participation-section  content-order animatedParent">
        <div class="row">
            <div class="col-md-6 col-sm-7  animated bounceInRight">
                <div class="login-bg login-form participation-form register-bg animatedParent">
                    <div class="main">
                        <h2 class="title-page">{{__('participation.Poll Participation')}}</h2>
                        <div class="theme-bar"></div>
                    </div>
                    @if(auth()->id())
                        <form action="{{ url("/poll-participate") }}" method="POST">
                    @else
                         <form action="{{ url("/") }}" method="POST">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>{{__('participation.Enter Polling key')}} </label>
                        <input type="text" name="polling_key" value="{{ old('polling_key') }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        @error('polling_key') <span class="error_msg">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group text-right">
                        <button>{{__('participation.PARTICIPATE TO A POLL')}}</button>
                    </div>
                     @guest(session('auth.current'))
                     <div  class="text-center create clr-wt pd-10">{{__('participation.Already have an account?')}}
                         <a class="clr-wt"
                            href="{{url('/login')}}"><strong>{{__('participation.Login')}}</strong></a>
                     </div>
                     @endguest
                    @if(auth()->id())
                       </form>
                    @else
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-5 participation-img login-img image animated bounceInLeft">
                <img src="{{asset('assets/images/login.svg')}}" alt="image">
            </div>
        </div>
    </div>
    </div>
@endsection
@section('extra_css')
    <style>
        .panel-table .panel-body .table-bordered {
            border-style: none;
            margin: 0;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
            text-align: center;
            width: 100px;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
        .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
            border-right: 0px;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
        .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
            border-left: 0px;
        }

        .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td {
            border-bottom: 0px;
        }

        .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th {
            border-top: 0px;
        }

        .panel-table .panel-footer .pagination {
            margin: 0;
        }

        /*
    used to vertically center elements, may need modification if you're not using default sizes.
    */
        .panel-table .panel-footer .col {
            line-height: 34px;
            height: 34px;
        }

        .panel-table .panel-heading .col h3 {
            line-height: 30px;
            height: 30px;
        }

        .panel-table .panel-body .table-bordered > tbody > tr > td {
            line-height: 34px;
        }

        .title-page {
            font-weight: 600;
        }

        .main {
            margin-bottom: 10px;
        }

        .theme-bar {
            width: 10%;
            height: 4px;
            background-color: #0044e4;
            margin-bottom: 20px;
        }


        .page-title .main {
            float: right;
            margin-bottom: 40px;
        }
    </style>
@endsection
