<?php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
?>
<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="{{url('/')}}" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="img-responsive" src="{{asset('public/img/smartlane.png')}}" alt="SmartLane">
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper ">
        <ul class="nav flex-column scrollbar">

            @php $permissions = config('super-admin-permissions'); @endphp

            @foreach($permissions as $key => $val)

            @if(isset($val['options']['sub-nav']))
            <li class="nav-item dropdown @if($segment1 == $val['options']['link']) active show @endif ">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="javascript::void(0);" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block">
                        <i class="fa {{$val['options']['fontawesome']}}"></i>
                        <span>{{$key}}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-small  @if($segment1 == $val['options']['link']) show @endif ">
                    @foreach($val['options']['sub-nav'] as $subnav_key => $subnav_val )
                    <a class="dropdown-item  @if($segment2 == $subnav_val['options']['link']) active @endif " href="{{url('/' . $val['options']['link'] . '/' . $subnav_val['options']['link'])}}">
                        <i class="fa {{$subnav_val['options']['fontawesome']}}"></i> {{$subnav_key}}
                    </a>
                    @endforeach 

                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link  @if($segment1 == '' || $segment1 == $val['options']['link']) active @endif " href="{{url('/' . $val['options']['link'])}}">
                    <i class="fa {{$val['options']['fontawesome']}}"></i>
                    <span>{{$key}}</span>
                </a>
            </li>
            @endif 

            @endforeach




            <!--            <li class="nav-item">
                            <a class="nav-link @if($segment1 == 'topup') active @endif " href="{{url('/topup')}}">
                                <i class="fa fa-credit-card"></i>
                                <span>TopUp <i class="fa fa-plus"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if($segment1 == 'send-parcels') active @endif " href="{{url('/send-parcels')}}">
                                <i class="fa fa-truck"></i>
                                <span>Send Parcel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if($segment1 == 'add-referrals') active @endif " href="{{url('/add-referrals')}}">
                                <i class="material-icons">group_add</i>
                                <span>Add Referrals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                <i class="fa fa-gift"></i>
                                <span>Rewards</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link @if($segment1 == 'quick-returns') active @endif " href="{{url('/quick-returns')}}">
                                <i class="fa fa-undo"></i>
                                <span>Quick Return</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($segment1 == 'marketing-tools') active @endif " href="{{url('/marketing-tools')}}">
                                <i class="fa fa-bullhorn"></i>
                                <span>Marketing Tools</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">
                                <i class="fa fa-credit-card"></i>
                                <span>Financial Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                <i class="fa fa-user"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                <i class="fa fa-wrench"></i>
                                <span>Tools</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('/')}}">
                                <i class="material-icons">headset_mic</i>
                                <span>Support</span>
                            </a>
                        </li>-->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="material-icons">&#xE879;</i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        <div class="row mb-4 mt-4 height-50px" ></div>
    </div>
</aside>
<!-- End Main Sidebar -->