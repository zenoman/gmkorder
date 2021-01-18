<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Top Navigation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('token')
<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
@yield('customcss')
<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts/nav')
  
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  
  <aside class="control-sidebar control-sidebar-dark" style="height:100%;">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@stack('customjs')
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
@stack('customscripts')
</body>
</html>
