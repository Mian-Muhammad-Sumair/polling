@extends('layouts.app')

@section('content')
<div class="container login-container content-order animatedParent">
    <div class="row justify-content-center">
        <div class="col-md-6 animated bounceInRight"">
            <div class=" main">
            <h2 class="title-page">Reset Password</h2>
            <div class="theme-bar"></div>
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->

                    <!-- <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form> -->
                    <div class="login-bg login-form register-bg animatedParent">

                        <form>
                            <div class="form-group">
                                <label>E-Mail Address</label>
                                <input type="text" name="email">
                                <!-- @error('email') <span>{{$message}}</span> @enderror -->
                            </div>

                            <div class="form-group text-right">
                                <button>Send password reset link</button>
                            </div>

                        </form>
                    </div>
                </div>
        </div>
        <div class="col-md-6 col-sm-5 login-img image animated bounceInLeft">
            <img src="{{asset('assets/images/login.svg')}}" alt="image">
        </div>
    </div>
    </div>
</div>
@endsection