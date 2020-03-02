<?php $__env->startSection('content'); ?>
  
  <section class="content-header">
      <h1>Page</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/page">Frontend</a></li>
        <li class="active">Page</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Page Information</h3>
            </div>
            <?php $__currentLoopData = $page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form role="form" enctype="multipart/form-data" action="<?php echo e(url('/page',[$obj->id])); ?>" method="post">
            <?php echo e(csrf_field()); ?>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        Logo
                        <?php 
                          if($obj->logo != null){
                            echo "(has logo already)";
                          }
                        ?>
                      </label>
                      <input type="file" name="logo" value="<?php echo e($obj->logo); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Header</label>
                      <textarea id='editor1' placeholder="Enter Header" name="header"><?php echo e($obj->header); ?></textarea>
                    </div>
                    <div class="form-group">
                    <label>Footer</label>
                    <div class="input-group">
                      <span class="input-group-addon">&copy;</span>
                      <input type="text" name="footer" value="<?php echo e($obj->footer); ?>" class="form-control" placeholder="Enter Footer">
                    </div>
                    </div>
                    <div class="form-group">
                      <label>
                        Background 1
                        <?php 
                          if($obj->background1 != null){
                            echo "(has background 1 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title1" value="<?php echo e($obj->title1); ?>" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg1" value="<?php echo e($obj->background1); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 1</label>
                      <input type="text" name="subject1" value="<?php echo e($obj->subject1); ?>" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor2' placeholder="Enter Content 1"
                                       name="content1"><?php echo e($obj->content1); ?></textarea>
                    </div>  
                    
                  </div>

                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label>
                        Background 2
                        <?php 
                          if($obj->background2 != null){
                            echo "(has background 2 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title2" value="<?php echo e($obj->title2); ?>" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg2" value="<?php echo e($obj->background2); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 2</label>
                      <input type="text" name="subject2" value="<?php echo e($obj->subject2); ?>" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor3' placeholder="Enter Content 2" name="content2"><?php echo e($obj->content2); ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>
                        Background 3
                        <?php 
                          if($obj->background3 != null){
                            echo "(has background 3 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title3" value="<?php echo e($obj->title3); ?>" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg3" value="<?php echo e($obj->background3); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 3</label>
                      <input type="text" name="subject3" value="<?php echo e($obj->subject3); ?>" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor4' placeholder="Enter Content 3" name="content3"><?php echo e($obj->content3); ?></textarea>
                    </div>
                    

                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>