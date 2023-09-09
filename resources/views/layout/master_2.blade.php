<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BDU-VEHICLE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.style')
    @yield('styles')
</head>

<body>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        @include('layout.header')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            {{-- @if (Auth::user()->role)

            @endif --}}
            @include('layout.sidebar')
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one" id="overflowHidden" style="overflow: hidden;">

                @yield('content')
            </div>
        </div>
       
        <!-- Page Area End Here -->
    </div>
    @include('layout.scripts')
    @yield('scripts')
</body>

</html>
