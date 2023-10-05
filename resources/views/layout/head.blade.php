<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}" />

      <title>
            @yield('title')
      </title>
      
      <link rel="icon" type="image/x-icon" href="{{ asset('AdminAssets/assets/img/favicon.ico') }}" />
      <link href="{{ asset('adminAssets/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
      <script src="{{ asset('adminAssets/assets/js/loader.js') }}"></script>

      <!-- BEGIN GLOBAL MANDATORY STYLES -->
      <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
      @if (LaravelLocalization::getCurrentLocale() == 'ar')
            <link href="{{ asset('adminRtl/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
      @else
            <link href="{{ asset('adminAssets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
      @endif
      <link href="{{ asset('adminAssets/plugins/font-icons/fontawesome/css/all.css') }}" rel="stylesheet"
            type="text/css" />
      <!-- END GLOBAL MANDATORY STYLES -->

      <link rel="stylesheet" href="{{ asset('adminAssets/assets/css/sweetalert.css') }}">

      @stack('css')
      <link rel="stylesheet" href="{{ asset('css/myStyles.css') }}">
</head>

<body class="alt-menu sidebar-noneoverflow">
      <!-- BEGIN LOADER -->
      <div id="load_screen">
            <div class="loader">
                  <div class="loader-content">
                        <div class="spinner-grow align-self-center"></div>
                  </div>
            </div>
      </div>
      <!--  END LOADER -->
