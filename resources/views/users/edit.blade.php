@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pt-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0 float-left">
        <span class="text-uppercase page-subtitle">
            <a href="{{url('/')}}">Dashboard</a>
            @if (\Request::is('users/create') || \Request::is('users/' . @Hashids::encode($user->id) . '/edit') )
            <a href="{{url('/users')}}"> / Users Management</a>
            @elseif (\Request::is('users/passengers/create') || \Request::is('users/passengers/' . @Hashids::encode($user->id) . '/edit') ) 
            <a href="{{url('/users/passengers')}}" > / Passengers Management</a>
            @endif 
            / {!!@ucfirst(@$action)!!} 
        </span>
        <h3 class="page-title">{{$action}} User</h3>
    </div>
</div>
<!-- End Page Header -->
<hr/>
<form class="form-inline form-validate custom-form"  action="{{url('/users')}}" method="POST" enctype="multipart/form-data">

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

                                    <input type="hidden" name="id" value="{{@Hashids::encode($user->id)}}">
                                    <input type="hidden" name="action" value="{{$action}}">
                                    {{ csrf_field() }}

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('first_name')) is-invalid @endif" id="first_name" name="first_name"  value="@if($action == 'Add'){{ old('first_name') }}@endif{{@$user->first_name}}" placeholder="Firstname">
                                            <span>Firstname</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('first_name'))
                                            {{ $errors->first('first_name') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('last_name')) is-invalid @endif" id="last_name" name="last_name"  value="@if($action == 'Add'){{ old('last_name') }}@endif{{@$user->last_name}}" placeholder="Lastname">
                                            <span>Lastname</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('last_name'))
                                            {{ $errors->first('last_name') }}
                                            @endif
                                        </label>
                                    </div>
                                    @if (\Request::is('users/create') || \Request::is('users/' . Hashids::encode(@$user->id) . '/edit'))
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('username')) is-invalid @endif" id="username" name="username"  value="@if($action == 'Add'){{ old('username') }}@endif{{@$user->username}}" placeholder="Username">
                                            <span>Username</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('username'))
                                            {{ $errors->first('username') }}
                                            @endif
                                        </label>
                                    </div>
                                    @endif 

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="email" name="email"  class="form-control w-100 @if($errors->has('email')) is-invalid @endif" id="email" value="@if($action == 'Add'){{ old('email') }}@endif{{@$user->email}}" placeholder="E-mail">
                                            <span>E-mail</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('email'))
                                            {{ $errors->first('email') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('phone')) is-invalid @endif" id="phone" name="phone"  value="@if($action == 'Add'){{ old('phone') }}@endif{{@$user->phone}}" placeholder="Phone Number">
                                            <span>Phone Number</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('phone'))
                                            {{ $errors->first('phone') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('cnic')) is-invalid @endif" id="cnic" name="cnic"  value="@if($action == 'Add'){{ old('cnic') }}@endif{{@$user->cnic}}" placeholder="CNIC Number">
                                            <span>CNIC Number</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('cnic'))
                                            {{ $errors->first('cnic') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('ntn')) is-invalid @endif" id="ntn" name="ntn"  value="@if($action == 'Add'){{ old('ntn') }}@endif{{@$user->ntn}}" placeholder="NTN Number">
                                            <span>NTN Number</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('ntn'))
                                            {{ $errors->first('ntn') }}
                                            @endif
                                        </label>
                                    </div>

                                    @if(@$action == 'Edit')
                                    <div class="form-group col-md-6 mb-4">
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <input type="checkbox" id="status" class="custom-control-input" name="status" value="1" @if($action == "Add" || @$user['status'] == 1) checked @endif />
                                                   <label class="custom-control-label" for="status"> Active / Inactive</label>
                                        </div>
                                        <div  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('status'))
                                            {{ $errors->first('status') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-4"></div>
                                    @endif
                                    @if (\Request::is('users/create') || \Request::is('users/' . Hashids::encode(@$user->id) . '/edit'))
                                    <div class="form-group col-md-6 mb-4"></div>
                                    @endif 

                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-address-book" aria-hidden="true"></i> Address Details</h6>
                                    </div>

                                    <div class="form-group col-md-12 mb-4 ">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_1')) is-invalid @endif" id="address_line_1" name="address_line_1"  value="@if($action == 'Add'){{ old('address_line_1') }}@endif{{@$user->address_line_1}}" placeholder="Address Line 1">
                                            <span>Address Line 1</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('address_line_1'))
                                            {{ $errors->first('address_line_1') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-12 mb-4 ">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('address_line_2')) is-invalid @endif" id="address_line_2" name="address_line_2"  value="@if($action == 'Add'){{ old('address_line_2') }}@endif{{@$user->address_line_2}}" placeholder="Address Line 2">
                                            <span>Address Line 2</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('address_line_2'))
                                            {{ $errors->first('address_line_2') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('state')) is-invalid @endif" id="state" name="state"  value="@if($action == 'Add'){{ old('state') }}@endif{{@$user->state}}" placeholder="State">
                                            <span>State</span>
                                        </label>
                                        <label class="invalid-feedback"  style="height: 20px;">
                                            @if($errors->has('state'))
                                            {{ $errors->first('state') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('postal_code')) is-invalid @endif" id="postal_code" name="postal_code"  value="@if($action == 'Add'){{ old('postal_code') }}@endif{{@$user->postal_code}}" placeholder="Postal / Zip">
                                            <span>Postal / Zip</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('postal_code'))
                                            {{ $errors->first('postal_code') }}
                                            @endif
                                        </label>
                                    </div>



                                    @if (\Request::is('users/passengers/create') || \Request::is('users/passengers/' . Hashids::encode(@$user->id) . '/edit'))
                                    <!-- Assign Store Section Start --> 
                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-sitemap" aria-hidden="true"></i> Assign Hotel <small>(If you want to add as passenger)</small></h6>
                                    </div>
                                    <div class="col-md-8 mb-4"></div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-group has-float-label floating-label-input">
                                            <select class="form-control  w-100  custom-select @if($errors->has('hotel_id')) is-invalid @endif " id="hotel_id" name="hotel_id" >
                                                <option value="">Select Hotel</option>
                                                @foreach($hotels as $hotel)
                                                @php $selected=''; @endphp 
                                                @if($hotel->id == @$user->hotel_id)
                                                @php $selected='selected'; @endphp 
                                                @endif 
                                                <option {{$selected}} value="{!!Hashids::encode(@$hotel->id)!!}">{!!@$hotel->name!!}</option>
                                                @endforeach
                                            </select>
                                            <span>Assign Hotel</span>
                                        </label>

                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('hotel_id'))
                                            {{ $errors->first('hotel_id') }}
                                            @endif
                                        </label>
                                    </div>
                                    <!--Assign Store Section End-->
                                    <input type="hidden" name="type" value="passengers" />
                                    @endif

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
                                <img src="{{checkImage(@$user->profile_img)}}"  class="image-display img-responsive img-thumbnail rounded mb-4 mt-3" />
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