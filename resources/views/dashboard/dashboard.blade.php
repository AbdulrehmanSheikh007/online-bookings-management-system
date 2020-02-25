@extends('layouts.app')
@section('content')
<style>
    .card.card-small {
        overflow-x: hidden !important;
    }
</style>
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Main Dashboard</h3>
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <div class="col-md-12">
        <!-- Small Stats Blocks -->
        <div class="card card-small mb-4 ml-3 mr-3">
            <div class="card-header border-bottom">
                <h6 class="m-0">Quick Summary</h6>
            </div>
            <div class="card-body p-0 pb-3 text-center container mt-4">

                <!--Cards Start-->
                <div class="col-md-2 col-sm-2 mb-2 float-left"></div>


                <div class="col-md-2 col-sm-2 mb-2 float-left">
                    <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Admin Users</span>
                                    <h6 class="stats-small__value count my-3">{!!$admins!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 mb-2 float-left">
                    <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Passengers</span>
                                    <h6 class="stats-small__value count my-3">{!!$passengers!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 mb-2 float-left">
                    <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Hotels</span>
                                    <h6 class="stats-small__value count my-3">{!!$hotels!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-2 col-sm-2 mb-2 float-left">
                    <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Bookings</span>
                                    <h6 class="stats-small__value count my-3">{!!$bookings!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Cards Ended-->
            </div>
        </div>

    </div>
</div>
@endsection