<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartLane') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link href="{{ asset('public/css/smartlane.css') }}" rel="stylesheet">

        @guest
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('public/css/bootstrap-float-label.min.css')}}">
        @else
        <link href="//use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/bootstrap-float-label.min.css')}}">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('public/styles/shards-dashboards.1.1.0.min.css')}}">

        <!-- Abdul's Especial StyleSheet-->
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('public/alertify/css/alertify.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/alertify/css/themes/default.min.css')}}">
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{asset('public/js/popper.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
          
        <script src="{{asset('public/alertify/alertify.min.js')}}"></script>
        
<!--        <script src="{{asset('public/gijgo/gijgo.min.js')}}" type="text/javascript"></script>
        <link href="{{asset('public/gijgo/gijgo.min.css')}}" rel="stylesheet" type="text/css" >-->

        
        <script src="{{asset('public/datepicker/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/datepicker/daterangepicker.js')}}" type="text/javascript"></script>
        <link href="{{asset('public/datepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" >

        <script>
var SITE_URL = site_url = "{{ url('/')}}";
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var APP_URL = "<?php echo URL::to('/'); ?>";
        </script>
        @endguest

    </head>
    <body class="h-100">
        <div id="app">

            @guest
            <main class="py-4">
                @yield('content')
            </main>

            @else
            <!-- Navigation Sidebar -->
            @include('sections.sidebar')
            <div class="container-fluid">
                <div class="row">
                    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                        <!-- Navigation Header -->
                        @include('sections.header')
                        <div class="main-content-container container-fluid px-4">

                            @if(Session::has('error_message'))
                            <div class="alert alert-danger fade in alert-dismissible show white mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" style="font-size:20px">×</span>
                                </button>    {{ Session::get('error_message') }}
                            </div>
                            <script>
                            alertify.notify("{{ Session::get('error_message') }}", 'error', 5);
                            </script>
                            @endif

                            @if(Session::has('success_message'))
                            <div class="alert alert-success fade in alert-dismissible show white mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" style="font-size:20px">×</span>
                                </button>    {{ Session::get('success_message') }}
                            </div>
                            <script>
                            alertify.notify("{{ Session::get('success_message') }}", 'success', 5);
                            </script>
                            @endif

                            @yield('content')
                        </div>
                        <!-- Navigation Footer -->
                        @include('sections.footer')
                    </main>
                </div>
            </div>
            @endguest 

        </div>

        <!-- Scripts -->
        @guest
        <script src="{{ asset('public/js/app.js') }}" defer></script>

        @else 
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('public/js/smartlane.js') }}" ></script>
        @endguest 

    </body>
</html>
