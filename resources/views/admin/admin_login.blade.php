<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{{asset('LTE/dist/img/gm.png')}}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GreymousePortal | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/plugins/iCheck/square/blue.css')}}">

 
 

  <style type="text/css">
    body{
      background-image: url('/LTE/dist/img/photo1.png');
      position:relative;
      /*opacity: 0.90;*/
      background-position: center;
      background-size:cover;
      background-repeat: no-repeat;
    }
  </style>

</head>
<!-- <body class="hold-transition login-page"> -->
<body class="hold-transition">
<div class="login-box" style="opacity: 0.90;">
  <div class="login-logo">
    <a href="/greymouse" style="color:black"><b>Greymouse</b>Portal</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
    <form action="{{url('admin')}}" method="post">
    {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="email" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <div class="col-xs-12">
          <a class="btn btn-link btn-flat pull-right" href="/requestreset">
              Forgot Your Password?
          </a>
        </div>
        
        
      </div>
    </form>
    @if($admin < 1)
    <a href="{{url('register')}}" class="btn btn-primary btn-block btn-flat">Register admin here</a>
    @endif
  </div>
</div>

<script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('LTE/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
