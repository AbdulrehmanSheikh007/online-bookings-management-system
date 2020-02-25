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
            Hotels Management
        </span>
        <h3 class="page-title">Hotels Management</h3>
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-body p-0 pb-3 text-center" style="padding: 2% !important;">
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
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Apply Filter</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 float-left text-right mb-4">
                                <a href="{{url('/hotels/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Hotel</a>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <table id="smartlane-tbl" class="table table-striped table-bordered smartlane-tbl" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th><i class="fa fa-shopping-bag"></i> Hotel</th>
                                    <th><i class="fa fa-envelope"></i> Email</th>
                                    <th><i class="fa fa-phone"></i> Contact</th>
                                    <th><i class="fa fa-map-marker"></i> City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp 
                                @foreach($hotels as $item)
                                @php $i++; @endphp 
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td style="width: 10%;"><img src="{{checkImage($item->logo)}}" class="image-display img-responsive img-thumbnail rounded" style="width: 100px; height: 100px;"></td>
                                    <td><a href="@if($item->website_uri){{$item->website_uri}}@elsejavascript::void(0);@endif" class=""><i class="fa fa-link"></i> {!!$item->name!!}</a></td>
                                    <td>{!!$item->email!!}</td>
                                    <td>{!!$item->UAN!!}</td>
                                    <td>{!!$item->city!!}</td>
                                    <td class="text-center">
                                        @if($item->status == 0)
                                        <i class="badge badge-danger">Inactive</i>
                                        @elseif($item->status == 1)
                                        <i class="badge badge-success">Active</i>
                                        @endif 
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" data-toggle="tooltip" title="Edit"   href="{{url('/hotels/'.Hashids::encode($item->id).'/edit')}}"><i class="fa fa-edit white" aria-hidden="true"></i></a>

                                        <form method="POST" action="{{url('/hotels/' .Hashids::encode($item->id))}}" accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                                            <button class="btn btn-danger delete-form-btn"  data-toggle="tooltip" title="Delete"  type="button"><i class="fa fa-trash fa-fw" title="Delete"></i></button>
                                            <input class="d-none deleteSubmit" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if (count($hotels) == 0)
                                <tr><td colspan="10"><div class="no-record-found alert alert-warning">No hotel found!</div></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3">
                        <nav class="pagination float-right">{!! $hotels->appends(Request::query())->links() !!}</nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection