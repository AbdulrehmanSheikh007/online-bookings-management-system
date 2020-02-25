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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="text-center mt-4 mb-4">
                            <h1>Welcome Back</h1>
                            <p>Access your account and manage your bookings</p>
                        </div>

                        @if(Session::has('error_message'))
                        <div class="alert alert-danger fade in alert-dismissible show white col-md-6 offset-md-3 input-group">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                            </button>    {{ Session::get('error_message') }}
                        </div>
                        @endif

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <label class="has-float-label custom-floating-label">
                                    <input id="username" type="username" autocomplete="off" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  placeholder="Username" >
                                    <span>Username</span>
                                </label>
                                @if($errors->has('username'))
                                <label  class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <label class="has-float-label custom-floating-label">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" >
                                    <span>Password</span>
                                </label>

                                @if($errors->has('password'))
                                <label  class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check pl-0">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                               <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>

                                    @if (Route::has('password.email'))
                                    <a class="float-right text-danger" href="{{ route('password.email') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block btn-bg-blue">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4 d-none">
                            <div class="col-md-8 offset-md-4">
                                <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
                            </div>
                        </div>						
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
