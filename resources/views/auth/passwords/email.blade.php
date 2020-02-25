@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center top-5rem">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('public/img/smartlane.png')}}" class="" />
                    </a>
                </div>

                <div class="card-body mb-4">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <div class="text-center mt-4 mb-4">
                            <h1>{{ __('Reset Password') }}</h1>
                            <p>We will send a resend password link to your email address.</p>
                        </div>
                        @if(Session::has('success_message'))
                        <div class="alert alert-success fade in alert-dismissible show white col-md-6 offset-md-3 input-group">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                            </button>    {{ Session::get('success_message') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>

                                <label class="has-float-label custom-floating-label">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="off" placeholder="Username">
                                    <span>Username</span>
                                </label>

                                @error('username')
                                <label class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </label>
                                @enderror

                                @if(Session::has('error_message'))
                                <label class="invalid-feedback" role="alert">
                                    <strong>{{ Session::get('error_message') }}</strong>
                                </label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-bg-blue">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-8 offset-md-4">
                                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
