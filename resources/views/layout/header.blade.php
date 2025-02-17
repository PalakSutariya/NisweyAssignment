<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

    {{-- Laravel CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('assets') }}/images/brand/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap css -->
    <link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap-multiselect.min.css" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('assets') }}/css/custom.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('assets') }}/plugins/animated/animated.css" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="{{ asset('assets') }}/css/sidemenu.css" rel="stylesheet">

    {{-- scroll --}}
    <link href="{{ asset('assets') }}/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets') }}/plugins/icons/icons.css" rel="stylesheet" />

    <link href="{{ asset('assets') }}/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/fileupload/css/fileupload.css" rel="stylesheet" />

    <!-- INTERNAL Data table css -->
    <link href="{{ asset('assets') }}/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

    <link href="{{ asset('assets') }}/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/notify/css/notifIt.css" rel="stylesheet" />

    @yield('css')

</head>

<body class="app sidebar-mini " id="index1">
    <div id="global-loader">
        <img src="{{ asset('assets') }}/images/svgs/loader.svg" alt="loader">
    </div>

    <div class="page">
