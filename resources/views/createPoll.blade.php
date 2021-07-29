@extends('layouts.app')
@section('title')
    Create Poll
@endsection
@section('extra_css')
    <style>
        .container{
            width: 80%;
        }
        .progress-card{
           padding:10px 30px;
            background-color: #F5F5F5;
            width: 60%;
            border-radius: 10px;
            margin-bottom: 15px;
            margin-top: 15px;
            -webkit-transition-property: color, background-color,  border;
            -webkit-transition-duration: 400ms, 400ms, 400ms, 400ms;
            border:2px solid #F5F5F5;

        }
        .create-pool .button-header{
            width: 60%;
        }
        .progress-card:hover{
            transition-timing-function: linear;
           border:2px solid #7158f4;
            background-color: white;


        }
        .progress{
            box-shadow: inset 0 0px 0px rgb(0 0 0);
        }

        .progress-card:hover .progress{
            background-color: white;
        }
        .progress-bar-custom-theme{
            background-color: #7158f4;
        }

        .progress-card .text h2{
           font-size: 28px;
        }
        .progress-card .text{
            margin-bottom: 10px;
        }
        .progress-bar{
            height: 30%;
            border-radius: 20px;
            margin-left:5px;
        }
        .main-heading{
           margin-bottom: 20px;
        }
        .main-heading h3{
            font-size: 30px;
            font-weight: 800;
        }
        .heading{
            margin-bottom: 40px;
        }
        .heading p{
            color: #333333;
        }
        .heading h3{
            font-size: 22px;
            font-weight: 800;
        }
        .next{
            background: white;
            color: #4F54A0;
            border: 2px solid #4F54A0;
            font-weight: 600;
        }
        .main-btn{
            float: right;
            margin-top:10px;
        }
        .main-btn .custom-btn{
            margin-left: 10px;
        }

        .next:hover{
            color: #2f3471;
        }
        .submit{
            background: #4F54A0;
            color: white;
            font-weight: 600;
            -webkit-transition-property:background;
            -webkit-transition-duration: 400ms, 400ms, 400ms, 400ms;
        }
        .submit:hover{
            background: #1e225e;

        }
        @media only screen and (max-width:1500px) {
            .progress-card, .button-header{
                width: 70% !important;
            }
        }
        @media only screen and (max-width:991px) {
            .progress-card,.button-header{
                width: 80% !important;
            }
            .container{
                width: 90%;
            }
        }

    </style>
@endsection
@section('content')
    <div class="container create-pool animatedParent">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12  animated bounceInLeft">
                <div class="main-heading">
                    <h3> Design Tools</h3>
                </div>
                <div  class="heading">
                    <h3> What design tool do use the most?</h3>
                    <p>Poll offered by xyz from 26th may 2020 to 28th may 2020</p>
                </div>


            </div>
            <div class="col-md-12 col-sm-12 col-lg-12  animated bounceInRight">
                <div class="progress-card  ">
                    <div class="text"><h2>Sketch</h2></div>
                    <div class="progress">
                        <div class="progress-bar bg-info progress-bar-custom-theme" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="10" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12  animated bounceInLeft">
                <div class="progress-card ">
                    <div class="text"><h2>Figma</h2></div>
                    <div class="progress">
                        <div class="progress-bar bg-info progress-bar-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="10" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12  animated bounceInRight">
                <div class="progress-card">
                    <div class="text"><h2>Photoshop</h2></div>
                    <div class="progress">
                        <div class="progress-bar bg-info progress-bar-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="10" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12  animated bounceInLeft">
                <div class="button-header">
                    <div class="main-btn">
                    <a href="" class="custom-btn next ">Next question</a>
                    <a href="" class="custom-btn submit">Submit your vote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
