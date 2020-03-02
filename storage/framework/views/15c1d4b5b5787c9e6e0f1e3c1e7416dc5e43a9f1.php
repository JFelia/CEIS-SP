<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Security Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('LTE/dist/css/AdminLTE.min.css')); ?>">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Complete the Registration<br><small><b>Fill out Required Fields</b></small></p>
    
    <?php 
      //print out validation errors
        foreach($errors->all() as $error){
          echo $error . "<br>";
        }
     ?>
    
    <?php if(Session::has('flash_message_error')): ?>
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <strong><?php echo session('flash_message_error'); ?></strong>
            </div>
        <?php endif; ?>
        <?php if(Session::has('flash_message_success')): ?>
            <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <strong><?php echo session('flash_message_success'); ?></strong>
            </div>
        <?php endif; ?>
    <form action="<?php echo e(url('admin/security')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

      <div class="box-body">
        <div class="form-group">
          <label>Password Recovery</label>
          <select class="form-control" name="resetquestion">
            <option value="">--Select security question--</option>
            <option>What is your pet's name?</option>
            <option>Where is your birth place?</option>
            <option>What is the first name of the person you first kissed?</option>
            <option>What is the last name of the teacher who gave you your first failing grade?</option>
            <option>What is your favorite movie?</option>
          </select>
          <?php echo $errors->first('resetquestion','<p class="alert alert-danger">:message</p>'); ?>

        </div>
        <div class="form-group">
          <label>Recovery Answer</label>
          <input type="password" class="form-control" placeholder="Input recovery answer" name="resetanswer" autocomplete="off">
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

<script src="<?php echo e(asset('LTE/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('LTE/plugins/iCheck/icheck.min.js')); ?>"></script>

</body>
</html>
