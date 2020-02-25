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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="text-center mt-4 mb-4">
                            <h1>{{ __('Reset Password') }}</h1>
                            <p>This link will be expired within 60 minutes.</p>
                        </div>

                        <input type="hidden" name="token" value="{{ $_token }}">
                        <input type="hidden" name="user_id" value="{!!Hashids::encode($User->id)!!}">

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <label class="has-float-label custom-floating-label">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $username ?? old('username') }}" required placeholder="Username" autocomplete="off" >
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

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>

                                <label class="has-float-label custom-floating-label">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="New Password" autocomplete="new-password">
                                    <span>New Password</span>
                                </label>

                                @error('password')
                                <label class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </label>
                                @enderror
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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
                                    <span>Confirm Password</span>
                                </label>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-bg-blue">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
