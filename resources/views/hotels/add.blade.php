@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pt-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0 float-left">
        <span class="text-uppercase page-subtitle">
            <a href="{{url('/')}}">Dashboard</a>
            <a href="{{url('/hotels')}}"> / Hotels Management</a>
            / {!!@ucfirst(@$action)!!}
        </span>
        <h3 class="page-title">{{$action}} Hotel</h3>
    </div>
</div>
<!-- End Page Header -->
<hr/>
<form class="form-inline form-validate custom-form" action="{{url('/hotels')}}" method="POST" enctype="multipart/form-data">

    <div class="row" style="padding: 3%;">
        <!--INVITE AREA--> 
        <div class="col-lg-9 col-md-9 col-sm-9 mb-4">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-body p-0 pb-3 text-center " style="padding: 0 3% !important;">
                            <div class="container">
                                <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                    <h6 class="m-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Primary Information</h6>
                                </div>

                                @if(isset($validated))
                                $errors = $validated->errors(); 
                                @endif
                                <div class="form-inline py-4">
                                    <input type="hidden" name="id" value="{{@Hashids::encode(@$hotel->id)}}">
                                    <input type="hidden" name="action" value="{{$action}}">
                                    {{ csrf_field() }}

                                    <!--Primary Information Start--> 
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('name')) is-invalid @endif" id="name" name="name"  value="@if($action == 'Add'){{ old('name') }}@endif{{@$hotel->name}}" placeholder="Hotel Name *">
                                            <span>Hotel Name *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('email')) is-invalid @endif" id="email" name="email"  value="@if($action == 'Add'){{ old('email') }}@endif{{@$hotel->email}}" placeholder="Hotel Email *">
                                            <span>Hotel Email *</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('email'))
                                            {{ $errors->first('email') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('UAN')) is-invalid @endif" id="UAN" name="UAN"  value="@if($action == 'Add'){{ old('UAN') }}@endif{{@$hotel->UAN}}" placeholder="UAN">
                                            <span>UAN</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('UAN'))
                                            {{ $errors->first('UAN') }}
                                            @endif
                                        </label>
                                    </div>
                                    @if($action == 'Add')
                                    <div class="col-md-6 mb-4"></div>
                                    @endif 

                                    <!--Primary Information End-->

                                    <!--Contact Person Information Start-->
                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-phone" aria-hidden="true"></i> Contact Information</h6>
                                    </div>
                                    <div class="col-md-8"></div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('contact_first_name')) is-invalid @endif" id="contact_first_name" name="contact_first_name"  value="@if($action == 'Add'){{ old('contact_first_name') }}@endif{{@$hotel->contact_first_name}}" placeholder="Firstname *">
                                            <span>Firstname *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('contact_first_name'))
                                            {{ $errors->first('contact_first_name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('contact_last_name')) is-invalid @endif" id="contact_last_name" name="contact_last_name"  value="@if($action == 'Add'){{ old('contact_last_name') }}@endif{{@$hotel->contact_last_name}}" placeholder="Lastname *">
                                            <span>Lastname *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('contact_last_name'))
                                            {{ $errors->first('contact_last_name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('contact_number_1')) is-invalid @endif" id="contact_number_1" name="contact_number_1"  value="@if($action == 'Add'){{ old('contact_number_1') }}@endif{{@$hotel->contact_number_1}}" placeholder="Contact Number 1 *">
                                            <span>Contact Number 1 *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('contact_number_1'))
                                            {{ $errors->first('contact_number_1') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('contact_number_2')) is-invalid @endif" id="contact_number_2" name="contact_number_2"  value="@if($action == 'Add'){{ old('contact_number_2') }}@endif{{@$hotel->contact_number_2}}" placeholder="Contact Number 2">
                                            <span>Contact Number 2</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('contact_number_2'))
                                            {{ $errors->first('contact_number_2') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('contact_email')) is-invalid @endif" id="contact_email" name="contact_email"  value="@if($action == 'Add'){{ old('contact_email') }}@endif{{@$hotel->contact_email}}" placeholder="Contact Email *">
                                            <span>Contact Email *</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('contact_email'))
                                            {{ $errors->first('contact_email') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <!--Contact Person Information End-->

                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-address-book" aria-hidden="true"></i> Address Details</h6>
                                    </div>
                                    <div class="col-md-8"></div>

                                    <div class="form-group col-md-12 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_1')) is-invalid @endif" id="address_line_1" name="address_line_1"  value="@if($action == 'Add'){{ old('address_line_1') }}@endif{{@$hotel->address_line_1}}" placeholder="Address Line 1 *">
                                            <span>Address Line 1 *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('address_line_1'))
                                            {{ $errors->first('address_line_1') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_2')) is-invalid @endif" id="address_line_2" name="address_line_2"  value="@if($action == 'Add'){{ old('address_line_2') }}@endif{{@$hotel->address_line_2}}" placeholder="Address Line 2">
                                            <span>Address Line 2</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('address_line_2'))
                                            {{ $errors->first('address_line_2') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('city')) is-invalid @endif" id="city" name="city"  value="@if($action == 'Add'){{ old('city') }}@endif{{@$hotel->city}}" placeholder="City *">
                                            <span>City *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('city'))
                                            {{ $errors->first('city') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('state')) is-invalid @endif" id="state" name="state"  value="@if($action == 'Add'){{ old('state') }}@endif{{@$hotel->state}}" placeholder="State *">
                                            <span>State *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('state'))
                                            {{ $errors->first('state') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('postal_code')) is-invalid @endif" id="postal_code" name="postal_code"  value="@if($action == 'Add'){{ old('postal_code') }}@endif{{@$hotel->postal_code}}" placeholder="Postal Code *">
                                            <span>Postal Code *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('postal_code'))
                                            {{ $errors->first('postal_code') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('country')) is-invalid @endif" id="country" name="country"  value="@if($action == 'Add'){{ old('country') }}@endif{{@$hotel->country}}" placeholder="Country *">
                                            <span>Country *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('country'))
                                            {{ $errors->first('country') }}
                                            @endif
                                        </label>
                                    </div>

                                    
                                    <div class="form-group col-md-12 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('website_uri')) is-invalid @endif" id="website_uri" name="website_uri"  value="@if($action == 'Add'){{ old('website_uri') }}@endif{{@$hotel->website_uri}}" placeholder="Website URI *">
                                            <span>Website URI *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('website_uri'))
                                            {{ $errors->first('website_uri') }}
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
                                <div class="form-group col-md-12 py-3">
                                    <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                        <input type="checkbox" id="status" class="custom-control-input" name="status" value="1"  @if($action == "Add" || @$hotel->status == 1) checked @endif >
                                               <label class="custom-control-label" for="status"> Active / Inactive</label>
                                    </div>  
                                </div>
                                <div class="card-header slane-border-bottom col-md-12 text-left">
                                    <h6 class="m-0"><i class="fa fa-picture-o"></i> Logo</h6>
                                </div>
                                <img src="{{checkImage(@$hotel->logo)}}" class="image-display img-responsive img-thumbnail rounded mb-4 mt-3">
                                <div class="input-group mb-3 file-upload-btn" onclick="chooseFile(this);">
                                    <button class="btn btn-primary col-md-12 text-left" type="button">
                                        <i class="fa fa-upload"> Change Logo</i>
                                        <input type="file" class="" is_photo="true" id="logo" name="logo">
                                        <input type="hidden" id="old_image" name="old_image" value="{{@$hotel->logo}}">
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