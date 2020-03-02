<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Reset Email Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/dist/css/AdminLTE.min.css')}}">
 
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/greymouse"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Type Email to proceed to next step</p>
    
    
    
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
    <form action="{{url('/requestreset')}}" method="post">
    {{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" placeholder="Input Email" name="email" autocomplete="off">
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('LTE/plugins/iCheck/icheck.min.js')}}"></script>

</body>
</html>
