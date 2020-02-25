@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pt-4">
    <div class="col-12 col-sm-2 text-center text-sm-left mb-0 float-left">
        <span class="text-uppercase page-subtitle">
            <a href="{{url('/')}}">Dashboard</a> / 
            Profile
        </span>
        <h3 class="page-title">My Profile</h3>
    </div>

    
</div>
<!-- End Page Header -->
<hr/>
<form class="form-inline form-validate custom-form"  method="POST" action="{!! url('/profile/'.Auth::user()->id) !!}" novalidate="novalidate" enctype="multipart/form-data">

    <div class="row" style="padding: 3%;">
        <!--INVITE AREA--> 
        <div class="col-lg-9 col-md-9 col-sm-9 mb-4">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-body p-0 pb-3 text-center " style="padding: 0 3% !important;">
                            <div class="container">

                                @if(isset($validated))
                                $errors = $validated->errors(); 
                                @endif

                                <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                    <h6 class="m-0"><i class="fa fa-phone" aria-hidden="true"></i> Contact Information</h6>
                                </div>
                                <div class="form-inline py-4">

                                    @method('PUT')
                                    <input type="hidden" name="action" id="action_profile" value="{{$action}}">
                                    {{ csrf_field() }}

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('first_name')) is-invalid @endif" id="first_name" name="first_name"  value="{{Auth::user()->first_name}}" placeholder="Firstname">
                                            <span>Firstname</span>
                                        </label>
                                        <label  class="invalid-feedback" >
                                            @if($errors->has('first_name'))
                                            {{ $errors->first('first_name') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('last_name')) is-invalid @endif" id="last_name" name="last_name"  value="{{Auth::user()->last_name}}" placeholder="Lastname">
                                            <span>Lastname</span>
                                        </label>
                                        <label  class="invalid-feedback" >
                                            @if($errors->has('last_name'))
                                            {{ $errors->first('last_name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="email" readonly class="form-control w-100 @if($errors->has('email')) is-invalid @endif" id="email" name="email"  value="{{Auth::user()->email}}" placeholder="E-mail">
                                            <span>E-mail</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('email'))
                                            {{ $errors->first('email') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('phone')) is-invalid @endif" id="phone" name="phone"  value="{{Auth::user()->phone}}" placeholder="Phone Number">
                                            <span>Phone Number</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('phone'))
                                            {{ $errors->first('phone') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('cnic')) is-invalid @endif" id="cnic" name="cnic"  value="{{Auth::user()->cnic}}" placeholder="CNIC Number">
                                            <span>CNIC Number</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('cnic'))
                                            {{ $errors->first('cnic') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('ntn')) is-invalid @endif" id="ntn" name="ntn"  value="{{Auth::user()->ntn}}" placeholder="NTN Number">
                                            <span>NTN Number</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('ntn'))
                                            {{ $errors->first('ntn') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-address-book" aria-hidden="true"></i> Address Details</h6>
                                    </div>

                                    <div class="form-group col-md-12 mb-4 ">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_1')) is-invalid @endif" id="address_line_1" name="address_line_1"  value="{{Auth::user()->address_line_1}}" placeholder="Address Line 1">
                                            <span>Address Line 1</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('address_line_1'))
                                            {{ $errors->first('address_line_1') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-12 mb-4 ">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_2')) is-invalid @endif" id="address_line_2" name="address_line_2"  value="{{Auth::user()->address_line_2}}" placeholder="Address Line 2">
                                            <span>Address Line 2</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('address_line_2'))
                                            {{ $errors->first('address_line_2') }}
                                            @endif
                                        </label>
                                    </div>

                                    
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('state')) is-invalid @endif" id="state" name="state"  value="{{Auth::user()->state}}" placeholder="State">
                                            <span>State</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('state'))
                                            {{ $errors->first('state') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('postal_code')) is-invalid @endif" id="postal_code" name="postal_code"  value="{{Auth::user()->postal_code}}" placeholder="Postal / Zip">
                                            <span>Postal / Zip</span>
                                        </label>
                                        <label class="invalid-feedback" >
                                            @if($errors->has('postal_code'))
                                            {{ $errors->first('postal_code') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <button class="btn btn-primary float-right" type="submit">
                                            <i class="fa fa-check white">
                                                Save
                                            </i>
                                        </button>
                                    </div>

                                    <div class="col-md-12 mb-4"></div>
                                    <div class="col-md-12 mb-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--PROFILE PICTURE AREA--> 
        <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-body p-0 pb-3 text-center" style="padding: 2% !important;">                       
                            <div class="container">
                                <div class="card-header slane-border-bottom col-md-12 text-left">
                                    <h6 class="m-0"><i class="fa fa-picture-o"></i> Photo</h6>
                                </div>
                                <img src="{{checkImage(Auth::user()->profile_img)}}" class="image-display img-responsive img-thumbnail rounded mb-4 mt-3" />
                                <div class="input-group mb-3 file-upload-btn" onclick="chooseFile(this);">
                                    <button class="btn btn-primary col-md-12 text-left" type="button">
                                        <i class="fa fa-upload"> Change Photo</i>
                                        <input type="file" class="" is_photo="true" id="profile_img" name="profile_img" />
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection