<?php $__env->startSection('content'); ?>

  <section class="content-header">
      <h1>Birthday Board</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Birthday Board</li>
      </ol>
    </section>
    
  <section class="content">
  <div class="row">

       <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <!-- <th>Box</th> -->
                  <th>No</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Birthday</th>
                  <th>Age</th>
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($c); ?></td>
                  <?php if($object->id == session()->get('user_id')): ?>
                  <td><a href="<?php echo e(url('profile')); ?>" title="view my profile"><b><?php echo e($object->name); ?></b></a></td>
                  <?php else: ?>
                  <td><a title="view profile" href="<?php echo e(url('/admin/staff-profile',[$object->id])); ?>"><?php echo e($object->name); ?></a></td>
                  <?php endif; ?>
                  <td><?php echo e($object->user_level); ?></td>
                  <td>
                  <?php 
                      $birthdate = $object->bday_year."-".$object->birthday;
                   ?>
                  <?php echo e(date('F d, Y', strtotime($birthdate))); ?></td>
                  <td>
                  <?php
                      $age = date('Y',strtotime(NOW())) - $object->bday_year;
                      if(date('m d', strtotime($birthdate)) < date('m d', strtotime(NOW()))){
                        echo $age;
                      }else{
                        $age = $age - 1;
                        echo $age;
                      }

                  ?>
                  </td>
                </tr>
                  <?php $c++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Help</h3>
            </div>
              <div class="box-body">
                <div class="box-body box-profile" style="font-size: 12px">
                    <p>View the <b>Profile</b> by clicking at their <b>Names</b></p>
                   
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>