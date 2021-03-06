@extends('layouts.app')
@section('content')
<?php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
?>
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">
            <a href="{{url('/')}}">Dashboard</a> / 
            Users
        </span>
        <h3 class="page-title">Users Management</h3>
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-body p-0 pb-3 text-center" style="padding: 2% !important;">
                        
                        <div class="col-md-12 mb-4">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold @if($segment2 == '') active btn-primary @endif" href="{{url('/users')}}">Admin Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold @if($segment2 == 'passengers') active btn-primary @endif" href="{{url('/users/passengers')}}">Passengers</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="col-md-8 float-left">
                                <form class="form-inline" method="get">
                                    <div class="form-group px-2">
                                        <input type="text" class="form-control px-4" name="search" id="search" placeholder="Search by Name, Email & Phone #" value="@if(isset($_REQUEST['search'])){{$_REQUEST['search']}}@endif" />
                                    </div>
                                    <div class="form-group px-2">
                                        <select id="status" class="form-control px-4" name="status">
                                            <option @if(isset($_REQUEST['status']) && $_REQUEST['status'] == -1) selected @endif  value="-1">All</option>
                                            <option @if(isset($_REQUEST['status']) && $_REQUEST['status'] == 1) selected @endif  value="1">Active</option>
                                            <option  @if(isset($_REQUEST['status']) && $_REQUEST['status'] == 0) selected @endif  value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group px-2">
                                        @if (\Request::is('users'))
                                        
                                        @elseif (\Request::is('users/passengers')) 
                                        <select name="hotel_id" id="hotel_id" class='form-control' >
                                            <option value="">Select Hotel</option>
                                            @foreach($hotels as $hotel)
                                            <option @if(isset($_REQUEST['hotel_id']) && $_REQUEST['hotel_id'] == \Hashids::encode($hotel->id)) selected @endif value="{!!\Hashids::encode($hotel->id)!!}">{!!$hotel->name!!}</option>
                                            @endforeach
                                        </select>
                                        @endif

                                    </div>
                                    <div class="form-group px-2">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Apply Filter</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 float-left text-right mb-4">
                                @if (\Request::is('users'))
                                <a href="{{url('/users/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>
                                @elseif (\Request::is('users/passengers')) 
                                <a href="{{url('/users/passengers/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>
                                @endif
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <table id="smartlane-tbl" class="table table-striped table-bordered smartlane-tbl mt-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if (\Request::is('users'))
                                    <th><i class="fa fa-user"></i> Username</th>
                                    @endif
                                    <th><i class="fa fa-user"></i> Fullname</th>
                                    <th><i class="fa fa-envelope"></i> Email</th>
                                    <th><i class="fa fa-phone"></i> Phone</th>
                                    @if (\Request::is('users/passengers')) 
                                    <th><i class="fa fa-shopping-bag"></i> Hotel</th>
                                    @endif 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp 
                                @foreach($users as $item)
                                @php $i++; @endphp 
                                <tr>
                                    <td>{{ $i }}</td>
                                    @if (\Request::is('users')) 
                                    <td>{!! $item->username !!}</td>
                                    @endif
                                    <td>{!! $item->first_name !!} {!! $item->last_name !!}</td>
                                    <td>{!! $item->email !!}</td>
                                    <td>{!! $item->phone !!}</td>
                                    @if (\Request::is('users/passengers')) 
                                    <td><a target="_blank" href="{{ $item->hotel->website_uri }}" class="badge badge-info white">{{ $item->hotel->name }}</a></td>
                                    @endif 
                                    <td>@if($item->status == 1) <label class="badge badge-success">Active</label> @else <label class="badge badge-danger">Inactive</label> @endif</td>
                                    <td>

                                        <!--For Admins and admin hotels tabs--> 
                                        @if(have_premission(8) && $item->id > 1 && $item->id != Auth::user()->id)

                                        @if (\Request::is('users'))
                                        <a class="btn btn-warning" data-toggle="tooltip" title="Edit"   href="{{url('/users/'.Hashids::encode($item->id).'/edit')}}"><i class="fa fa-edit white" aria-hidden="true"></i></a>
                                        @elseif (\Request::is('users/passengers')) 
                                        <a class="btn btn-warning" data-toggle="tooltip" title="Edit"   href="{{url('/users/passengers/'.Hashids::encode($item->id).'/edit')}}"><i class="fa fa-edit white" aria-hidden="true"></i></a>
                                        @endif 

                                        @php $link = 'users/' @endphp 

                                        @if(\Request::is('users/passengers')) 
                                        @php $link = 'users/passengers/' @endphp 
                                        @endif 

                                        <form method="POST" action="{{url('/'. $link .Hashids::encode($item->id))}}" accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                                            <button class="btn btn-danger delete-form-btn"  data-toggle="tooltip" title="Delete"  type="button"><i class="fa fa-trash fa-fw" title="Delete"></i></button>
                                            <input class="d-none deleteSubmit" type="submit" value="Delete">
                                        </form>
                                        
                                        @endif

                                        <!--For hotels loggedin portals--> 

                                    </td>
                                </tr>
                                @endforeach
                                @if (count($users) == 0)
                                <tr><td colspan="9"><div class="no-record-found alert alert-warning">No user found!</div></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3">
                        <nav class="pagination float-right">{!! $users->appends(Request::query())->links() !!}</nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection