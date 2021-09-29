@extends('layouts.app')
@section('title')
    Sign Up
@endsection
@section('extra_css')
    <style>
        .images img{
            float: right;
        }

        .title-page{
            font-weight: 600;
        }
        .page-title{
            width: 17%;
        }
        .main{
            margin-bottom: 10px;
        }
        .theme-bar{
            width: 10%;
            height: 4px;
            background-color: #0044e4;
            margin-bottom: 20px;
        }
        .register-container{
            width: 100%;
        }
    </style>
@endsection
@section('content')

    <div class="container register-container content-order animatedParent" >
        <div class="row">
            <div class="col-md-6 register-img images animated bounceInLeft ">
                <img class="" src="{{asset('assets/images/register.png?v=1')}}" alt="image">
            </div>
            <div class="col-md-6 animated bounceInRight">
                <div class="login-bg register-bg animatedParent">
                    <div class="main">
                        <h2 class="title-page" >Register</h2>
                        <div class="theme-bar"></div>
                    </div>
                    <form class="">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" required>
                        </div>
                        <div class="form-group">
                            <label>Conform Password </label>
                            <input type="password" required>
                        </div>
                        <div class="form-group text-right">
                            <button>Register</button>
                        </div>
                        <div  class="text-center create clr-wt pd-10">Already have an account? <a class="clr-wt" href="login.php">Login</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
