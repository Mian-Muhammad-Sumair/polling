@extends('layouts.app')
@section('title')
    {{__('participation.Poll Participation')}}
@endsection
@section('content')
<div class="container  participation-section  content-order animatedParent">
    <div class="row">
        <div class="col-md-6 col-sm-12  animated bounceInRight">
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
{{--                <form action="{{ url(auth()->id()!='/'? "/" : "/pollParticipate") }}" method="POST">--}}
{{--                <form action="{{ url(auth()->id()!=''? "/" : "/pollParticipate") }}" method="POST">--}}
{{--                <form action="{{ url(auth()->id()>0?'/': '/pollParticipate'  ) }}" method="POST">--}}
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
                               <div class="text-center create clr-wt pd-10"{{__('participation.Already have an account?')}}> <a class="clr-wt" href="{{url('/login')}}"><strong>{{__('participation.Login')}}</strong></a></div>
                           @endguest
                </form>
            </div>
</div>
        <div class="col-md-6 col-sm-12 participation-img login-img image animated bounceInLeft">
            <img src="{{asset('assets/images/login.svg')}}" alt="image">
        </div>
        </div>
{{--        <div class="col-md-12 col-sm-5">--}}
{{--            <br><br>--}}
{{--            <div class="panel panel-default panel-table">--}}
{{--                <div class="panel-heading">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col col-xs-6">--}}
{{--                            <h3 class="panel-title">Panel Heading</h3>--}}
{{--                        </div>--}}
{{--                        <div class="col col-xs-6 text-right">--}}
{{--                            <a href="https://www.youtube.com/channel/UC_osRDuNAp1ZZxKckdKlNsw?sub_confirmation=1"><button type="button" class="btn btn-sm btn-primary btn-create">Create New Task</button></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="panel-body">--}}
{{--                    <table class="table table-striped table-bordered table-list">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th><i class="fa fa-cog"></i></th>--}}
{{--                                <th class="hidden-xs">ID</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Email</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <a class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                                <td class="hidden-xs">1</td>--}}
{{--                                <td>Master Shine</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <a class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                                <td class="hidden-xs">1</td>--}}
{{--                                <td>Master Shine</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <a class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                                <td class="hidden-xs">1</td>--}}
{{--                                <td>Master Shine</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <a class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                                <td class="hidden-xs">1</td>--}}
{{--                                <td>Master Shine</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td align="center">--}}
{{--                                    <a class="btn btn-default"><i class="fa fa-pencil"></i></a>--}}
{{--                                    <a class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                                <td class="hidden-xs">1</td>--}}
{{--                                <td>Master Shine</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                                <td>name@domain.com</td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                </div>--}}
{{--                <div class="panel-footer">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col col-xs-4">Page 1 of 5--}}
{{--                        </div>--}}
{{--                        <div class="col col-xs-8">--}}
{{--                            <ul class="pagination hidden-xs pull-right">--}}
{{--                                <li><a href="#">1</a></li>--}}
{{--                                <li><a href="#">2</a></li>--}}
{{--                                <li><a href="#">3</a></li>--}}
{{--                                <li><a href="#">4</a></li>--}}
{{--                                <li><a href="#">5</a></li>--}}
{{--                            </ul>--}}
{{--                            <ul class="pagination visible-xs pull-right">--}}
{{--                                <li><a href="#">«</a></li>--}}
{{--                                <li><a href="#">»</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
@section('extra_css')
<style>
    .panel-table .panel-body .table-bordered {
        border-style: none;
        margin: 0;
    }

    .panel-table .panel-body .table-bordered>thead>tr>th:first-of-type {
        text-align: center;
        width: 100px;
    }

    .panel-table .panel-body .table-bordered>thead>tr>th:last-of-type,
    .panel-table .panel-body .table-bordered>tbody>tr>td:last-of-type {
        border-right: 0px;
    }

    .panel-table .panel-body .table-bordered>thead>tr>th:first-of-type,
    .panel-table .panel-body .table-bordered>tbody>tr>td:first-of-type {
        border-left: 0px;
    }

    .panel-table .panel-body .table-bordered>tbody>tr:first-of-type>td {
        border-bottom: 0px;
    }

    .panel-table .panel-body .table-bordered>thead>tr:first-of-type>th {
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

    .panel-table .panel-body .table-bordered>tbody>tr>td {
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
