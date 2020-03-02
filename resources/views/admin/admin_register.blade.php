<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/plugins/iCheck/square/blue.css')}}">
  
 
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/greymouse"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new Admin<br><small><b>Fill out Required Fields</b></small></p>
    
    <?php 
     
     ?>
    
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
    <form action="{{url('register')}}" method="post">
    {{csrf_field()}}
      <div class="box-body">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" placeholder="Enter Full Name" name="name" autocomplete="off" value="{{old('name')}}">
                  {!! $errors->first('name','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Extension 1 <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Extension 1" name="ext1" autocomplete="off" value="{{old('ext1')}}">
                </div>
                <div class="form-group">
                  <label>Extension 2 <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Extension 2" name="ext2" autocomplete="off" value="{{old('ext2')}}">
                </div>
                <div class="form-group">
                  <label>Extension 3 <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Extension 3" name="ext3" autocomplete="off" value="{{old('ext3')}}">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off" value="{{old('username')}}">
                  {!! $errors->first('username','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Birthday:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                      <input type="text" name="birthday" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask value="{{old('birthday')}}">
                  </div>
                  {!! $errors->first('birthday','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off" value="{{old('email')}}">
                  {!! $errors->first('email','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
                  {!! $errors->first('password','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Re-type Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" value="{{old('cpassword')}}">
                  {!! $errors->first('cpassword','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Telephone <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Telephone Number" name="telephone" autocomplete="off" value="{{old('telephone')}}">
                </div>
                <div class="form-group">
                  <label>Skype <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Skype Account" name="skype" autocomplete="off" value="{{old('skype')}}">
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" placeholder="Enter Address" name="address" autocomplete="off" value="{{old('address')}}">
                  {!! $errors->first('address','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control" placeholder="Enter City" name="city" autocomplete="off" value="{{old('city')}}">
                  {!! $errors->first('city','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Region</label>
                  <input type="text" class="form-control" placeholder="Enter State" name="state" autocomplete="off" value="{{old('state')}}">
                  {!! $errors->first('state','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <input type="text" class="form-control" placeholder="Enter Country" name="country" autocomplete="off" value="{{old('country')}}">
                  {!! $errors->first('country','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Zip</label>
                  <input type="text" class="form-control" placeholder="Enter Zip Code" name="zip" autocomplete="off" value="{{old('zip')}}">
                  {!! $errors->first('zip','<p class="alert alert-danger">:message</p>') !!}
                </div>
                <div class="form-group">
                  <label>Education <small>(optional)</small></label>
                  <input type="text" class="form-control" placeholder="Enter Greatest Educational Attainment" name="educ" autocomplete="off" value="{{old('educ')}}">
                </div>
                
              </div>
              
      <input type="hidden" class="form-control" name="user_level" value="Admin">
      
      <div class="row">
       
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      </div>
    </form>
   
  </div>
</div>

<script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('LTE/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
     //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
  });
</script>
</body>
</html>
