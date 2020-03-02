<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{{asset('LTE/dist/img/gm.png')}}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GreymousePortal | Frontend</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('LTE/style.css')}}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('LTE/dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('LTE/dist/css/skins/_all-skins.min.css')}}">
  
  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<body class="hold-transition skin-blue layout-top-nav">
<!-- <div class="wrapper"> -->

@if(Session::has('flash_message_error'))
              <div class="alert alert-dismissable alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <strong><i class="icon fa fa-ban"></i>{!! session('flash_message_error') !!}</strong>
              </div>
          @endif
@if(count($errors)>0)
          <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
            </div>
        @endif
        
  @if(Session::has('flash_message_success'))
              <div class="alert alert-dismissable alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                      <strong><i class="icon fa fa-check"></i>{!! session('flash_message_success') !!}</strong>
              </div>
          @endif
@include('layouts.frontendLayout.front_header')
<!-- <div class="content-wrapper"> -->
  
      @yield('content')
  <!-- </div> -->
<!-- </div> -->

<script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('LTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('LTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('LTE/dist/js/adminlte.min.js')}}"></script>



</body>
</html>