<?php $__env->startSection('content'); ?>

  <section class="content-header">
      <h1>
        Sent Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/messages">Messages</a></li>
        <li class="active">Sent Items</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
        <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              <table id="example3" class="table table-bordered table-striped">
              <thead style="font-size: 12px">
                <th>No.</th>
                <th>Date & Time</th>
                <th>Client</th>
                <th>Sender (To:) - Message</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php $c = 1; ?>
                <?php if(Auth::user()->user_level != 'Client'): ?>
                  <?php $__currentLoopData = $outbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr style="font-size: 11px">
                    <td><?php echo e($c); ?></td>
                    <td style="text-align:center"><?php echo e(date('F d, Y h:i:sa',strtotime($object->created_at))); ?></td>
                    <td><a href="<?php echo e(url('/clients/client-profile',[$object->client_id])); ?>"><?php echo e($object->client_name); ?></a></td>
                    <td><p><b style="color:#666666"><?php echo e($object->sender); ?></b> <b style="color:#4dc3ff">(+<?php echo e($object->contact_no); ?>)</b> - <?php echo e($object->message); ?></p></td>
                    <td style="text-align:center">
                    <a href="<?php echo e(url('/messages/forward',[$object->message_id])); ?>" title="forward"><span class="fa fa-share-alt"></span></a>
                    </td>
                  </tr>
                  <?php $c++; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <?php $__currentLoopData = $outbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($object->client_id == Auth::user()->id): ?>
                    <tr style="font-size: 11px">
                      <td><?php echo e($c); ?></td>
                      <td style="text-align:center"><?php echo e(date('F d, Y h:i:sa',strtotime($object->created_at))); ?></td>
                      <td><a href="<?php echo e(url('/clients/client-profile',[$object->client_id])); ?>"><?php echo e($object->client_name); ?></a></td>
                      <td><p><b style="color:#666666"><?php echo e($object->sender); ?></b> <b style="color:#4dc3ff">(+<?php echo e($object->contact_no); ?>)</b> - <?php echo e($object->message); ?></p></td>
                      <td style="text-align:center">
                      <a href="<?php echo e(url('/messages/forward',[$object->message_id])); ?>" title="forward"><span class="fa fa-share-alt"></span></a>
                      </td>
                    </tr>
                    <?php $c++; ?>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
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
                    <p>Can <b>Forward</b> message by clicking the <b>Share button</b> on the right side of the message at the <b>Action</b> field</p>
                    <hr>
                    <p><b>Take note!</b></p>
                    <p><b>Client</b> is the one who request to send a message.</p>
                </div>
              </div>
            </div>
        </div>
          </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>