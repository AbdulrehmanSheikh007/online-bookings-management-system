@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pt-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0 float-left">
        <span class="text-uppercase page-subtitle">
            <a href="{{url('/')}}">Dashboard</a>
            <a href="{{url('/bookings')}}"> / Bookings Management</a>
            / {!!@ucfirst(@$action)!!}
        </span>
        <h3 class="page-title">{{$action}} Booking</h3>
    </div>
</div>
<!-- End Page Header -->
<hr/>
<form class="form-inline form-validate custom-form" action="{{url('/bookings')}}@if(@$action != 'Add')/{{@Hashids::encode(@$booking->id)}}@endif" method="POST" enctype="multipart/form-data">

    <div class="row" style="padding: 3%;">
        <!--INVITE AREA--> 
        <div class="col-lg-8 col-md-8 col-sm-8 mb-4">
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
                                    <input type="hidden" name="id" value="{{@Hashids::encode(@$booking->id)}}">
                                    <input type="hidden" name="action" value="{{$action}}">
                                    {{ csrf_field() }}

                                    @if(@$action != 'Add')
                                    @method('PUT')
                                    @endif 

                                    <!--Primary Information Start--> 
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-group has-float-label floating-label-input">
                                            <select class="form-control  w-100  custom-select @if($errors->has('hotel_id')) is-invalid @endif " id="hotel_id" name="hotel_id" >
                                                <option value="">Select Hotel</option>
                                                @foreach($hotels as $hotel)
                                                @php $selected=''; @endphp 
                                                @if($hotel->id == @$booking->hotel_id)
                                                @php $selected='selected'; @endphp 
                                                @endif 
                                                <option {{$selected}} value="{!!Hashids::encode(@$hotel->id)!!}">{!!@$hotel->name!!}</option>
                                                @endforeach
                                            </select>
                                            <span>Select Hotel</span>
                                        </label>

                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('hotel_id'))
                                            {{ $errors->first('hotel_id') }}
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('adults')) is-invalid @endif" id="adults" name="adults" value="@if($action == 'Add'){{ old('adults') }}@endif{{@$booking->adults}}" placeholder="No. of adults">
                                            <span>Adults *</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('adults'))
                                            {{ $errors->first('adults') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('children')) is-invalid @endif" id="children" name="children"  value="@if($action == 'Add'){{ old('children') }}@endif{{@$booking->children}}" placeholder="No. of children">
                                            <span>Children</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('children'))
                                            {{ $errors->first('children') }}
                                            @endif
                                        </label>
                                    </div>


                                    <div class="col-md-6 mb-4"></div>

                                    <!--Primary Information End-->

                                    <!--Contact Person Information Start-->
                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-phone" aria-hidden="true"></i> Contact Information</h6>
                                    </div>
                                    <div class="col-md-8"></div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('first_name')) is-invalid @endif" id="first_name" name="first_name"  value="@if($action == 'Add'){{ old('first_name') }}@endif{{@$booking->first_name}}" placeholder="Firstname *">
                                            <span>Firstname *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('first_name'))
                                            {{ $errors->first('first_name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('last_name')) is-invalid @endif" id="last_name" name="last_name"  value="@if($action == 'Add'){{ old('last_name') }}@endif{{@$booking->last_name}}" placeholder="Lastname *">
                                            <span>Lastname *</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('last_name'))
                                            {{ $errors->first('last_name') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('email')) is-invalid @endif" id="email" name="email" value="@if($action == 'Add'){{ old('email') }}@endif{{@$booking->email}}" placeholder="Booking Email *">
                                            <span>Booking Email *</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('email'))
                                            {{ $errors->first('email') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('phone')) is-invalid @endif" id="phone" name="phone"  value="@if($action == 'Add'){{ old('phone') }}@endif{{@$booking->phone}}" placeholder="phone">
                                            <span>phone</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('phone'))
                                            {{ $errors->first('phone') }}
                                            @endif
                                        </label>
                                    </div>


                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('cnic')) is-invalid @endif" id="cnic" name="cnic" value="@if($action == 'Add'){{ old('cnic') }}@endif{{@$booking->cnic}}" placeholder="Booking CNIC *">
                                            <span>CNIC *</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('cnic'))
                                            {{ $errors->first('cnic') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('ntn')) is-invalid @endif" id="ntn" name="ntn"  value="@if($action == 'Add'){{ old('ntn') }}@endif{{@$booking->ntn}}" placeholder="NTN#">
                                            <span>NTN</span>
                                        </label>
                                        <label class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('ntn'))
                                            {{ $errors->first('ntn') }}
                                            @endif
                                        </label>
                                    </div>

                                    
                                    <div class="card-header slane-border-bottom mb-4 col-md-4 text-left">
                                        <h6 class="m-0"><i class="fa fa-dollar" aria-hidden="true"></i> Payment Details </h6>
                                    </div>
                                    <div class="col-md-8 mb-4"></div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('total')) is-invalid @endif" id="total" name="total"  value="@if($action == 'Add'){{ old('total') }}@endif{{@$booking->total}}" placeholder="Total Amount">
                                            <span>Total Amount</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('total'))
                                            {{ $errors->first('total') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <input type="text" class="form-control w-100 @if($errors->has('advance')) is-invalid @endif" id="advance" name="advance"  value="@if($action == 'Add'){{ old('advance') }}@endif{{@$booking->advance}}" placeholder="Advance Paid">
                                            <span>Advance Paid</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('advance'))
                                            {{ $errors->first('advance') }}
                                            @endif
                                        </label>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <label class="has-float-label floating-label-input">
                                            <textarea class="form-control w-100 @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes"  placeholder="Booking Notes">@if($action == 'Add'){{ old('notes') }}@endif{{@$booking->notes}}</textarea>
                                            <span>Booking Notes</span>
                                        </label>
                                        <label  class="invalid-feedback" style="height: 20px;">
                                            @if($errors->has('notes'))
                                            {{ $errors->first('notes') }}
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
        <div class="col-lg-4 col-md-4 col-sm-4 mb-4">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-body p-0 pb-3 text-center" style="padding: 2% !important;">                       
                            <div class="container">
                                @if(@$booking->checkout_at < date("Y-m-d H:i:s" ) && $action == "Edit")
                                <div class="card-header slane-border-bottom col-md-12 text-left">
                                    <h6 class="m-0 red"><i class="fas fa-ban red"></i> Booking Expired</h6>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-3">This booking has been expired.</div>
                                @endif 
                                <div class="form-group col-md-12 py-3">
                                    <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                        <input type="checkbox" id="status" class="custom-control-input" name="status" value="1"  @if($action == "Add" || @$booking->status == 1) checked @endif >
                                               <label class="custom-control-label" for="status"> Active / Inactive</label>
                                    </div>  
                                </div>
                                <div class="card-header slane-border-bottom col-md-12 text-left">
                                    <h6 class="m-0"><i class="fas fa-calendar"></i> Booking Duration</h6>
                                </div>
                                <div class="form-group col-md-12 pl-3 mt-3">
                                    <label class="has-float-label floating-label-input">
                                        <input type="text" class="form-control w-100 datetime_range @if($errors->has('booking_duration')) is-invalid @endif" id="booking_duration" name="booking_duration"  value="@if($action == 'Add'){{ old('booking_duration') }}@endif{{@$booking_duration}}" placeholder="Booking Duration *">
                                        <span>Booking Duration *</span>
                                    </label>
                                    <label class="invalid-feedback" style="height: 20px;">
                                        @if($errors->has('booking_duration'))
                                        {{ $errors->first('booking_duration') }}
                                        @endif
                                    </label>
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