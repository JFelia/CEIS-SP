<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if(Auth::user()->avatar != 'default_user.png'): ?>
          <img src="/LTE/dist/img/small/<?php echo e(Auth::user()->avatar); ?>" class="img-circle" alt="User Image">
          <?php else: ?>
          <img src="/LTE/dist/img/<?php echo e(Auth::user()->avatar); ?>" class="img-circle" alt="User Image">
          <?php endif; ?>
          
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/admin/dashboard' ? 'class=active' : '')); ?>>
          <a href="<?php echo e(url('/admin/dashboard')); ?>" >
            <i class="fa fa-home text-aqua"></i> <span class="side-b">Home</span>
          </a>
        </li>
        <?php if(session()->get('user_level') != 'Client'){ ?>
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/profile' ? 'class=active' : '')); ?>><a href="<?php echo e(url('profile')); ?>"><i class="fa fa-user text-aqua"></i> <span class="side-b">Profile</span></a></li>
        <?php }else{ ?>
            <?php if(url()->current()=='http://127.0.0.1:8000/clients/client-profile/'.Auth::user()->id): ?>
              <li class="active">
            <?php else: ?>
              <li>
            <?php endif; ?>
              <a href="<?php echo e(url('/clients/client-profile',Auth::user()->id)); ?>"><i class="fa fa-user text-aqua"></i> <span class="side-b">Profile</span></a></li>
        <?php } ?>

          <?php if(url()->current()=='http://127.0.0.1:8000/messages/create'
            || url()->current()=='http://127.0.0.1:8000/messages'
            || url()->current()=='http://127.0.0.1:8000/emails'
            || url()->current()=='http://127.0.0.1:8000/viewgetintouch'): ?>
          <li class="active treeview">
          <?php else: ?>
          <li class="treeview">
          <?php endif; ?>
          <a href="#">
            <i class="fa fa-envelope text-yellow"></i>
            <span class="side-b">Messages</span>
            <span class="pull-right-container">
              <?php if(Auth::user()->user_level != 'Client'): ?>
              <span class="label label-danger pull-right" title="get in touch"><?php echo e($getintouch); ?></span>
              <?php endif; ?>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/messages/create' ? 'class=active' : '')); ?>><a href="<?php echo e(route('messages.create')); ?>"><i class="fa fa-circle-o text-aqua"></i> Compose SMS</a></li>
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/messages' ? 'class=active' : '')); ?>><a href="<?php echo e(route('messages.index')); ?>"><i class="fa fa-circle-o text-aqua"></i> Sent Items</a></li>
            <?php if(Auth::user()->user_level != 'Client'): ?>
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/viewgetintouch' ? 'class=active' : '')); ?>>
              <a href="<?php echo e(url('/viewgetintouch')); ?>"><i class="fa fa-circle-o text-aqua"></i> Get in touch
                <span class="pull-right-container">
                    <span class="label label-danger pull-right" title="get in touch"><?php echo e($getintouch); ?></span>
                  </span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        
        
        
        
        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
          <?php if(url()->current()=='http://127.0.0.1:8000/user_roles'
            || url()->current()=='http://127.0.0.1:8000/type_of_leave'): ?>
          <li class="active treeview">
          <?php else: ?>
          <li class="treeview">
          <?php endif; ?>
          <a href="#">
            <i class="fa fa-list text-red"></i>
            <span class="side-b">Dynamic Data Center</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/user_roles' ? 'class=active' : '')); ?>>
                  <a href="<?php echo e(url('/user_roles')); ?>" >
                    <i class="fa fa-circle-o text-aqua"></i> User Roles
                  </a>
                </li>
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/type_of_leave' ? 'class=active' : '')); ?>>
                  <a href="<?php echo e(url('/type_of_leave')); ?>" >
                    <i class="fa fa-circle-o text-aqua"></i> Type of Leave
                  </a>
                </li>
                
              </ul>
        </li>
        <?php } ?>

        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
          <?php if(url()->current()=='http://127.0.0.1:8000/files'
            || url()->current()=='http://127.0.0.1:8000/admin/addstaff'
            || url()->current()=='http://127.0.0.1:8000/admin/staffs'
            || url()->current()=='http://127.0.0.1:8000/clients/create'
            || url()->current()=='http://127.0.0.1:8000/clients'
            || url()->current()=='http://127.0.0.1:8000/won_index'
            || url()->current()=='http://127.0.0.1:8000/lost_index'): ?>
          <li class="active treeview">
          <?php else: ?>
          <li class="treeview">
          <?php endif; ?>
          <a href="#">
            <i class="fa fa-group text-aqua"></i>
            <span class="side-b">People</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/files' ? 'class=active' : '')); ?>><a href="<?php echo e(route('files.index')); ?>"><i class="fa fa-circle-o text-aqua"></i> Applicants</a></li>
            <?php if(url()->current()=='http://127.0.0.1:8000/admin/addstaff'
              || url()->current()=='http://127.0.0.1:8000/admin/staffs'): ?>
            <li class="active treeview">
            <?php else: ?>
            <li class="treeview">
            <?php endif; ?>
              <a href="#"><i class="fa fa-circle-o text-aqua"></i> Employees
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/admin/addstaff' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/admin/addstaff')); ?>"><i class="fa fa-circle-o text-aqua"></i> Add Employee</a></li>
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/admin/staffs' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/admin/staffs')); ?>"><i class="fa fa-circle-o text-aqua"></i> View Employees</a></li>
              </ul>
            </li>
            <?php if(url()->current()=='http://127.0.0.1:8000/clients/create'
              || url()->current()=='http://127.0.0.1:8000/clients'
              || url()->current()=='http://127.0.0.1:8000/won_index'
              || url()->current()=='http://127.0.0.1:8000/lost_index'): ?>
            <li class="active treeview">
            <?php else: ?>
            <li class="treeview">
            <?php endif; ?>
              <a href="#"><i class="fa fa-circle-o text-aqua"></i> Clients
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/clients/create' ? 'class=active' : '')); ?>><a href="<?php echo e(route('clients.create')); ?>"><i class="fa fa-circle-o text-aqua"></i> Add Prospect Client</a></li>
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/clients' ? 'class=active' : '')); ?>><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-circle-o text-aqua"></i> View Prospect Clients</a></li>
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/won_index' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/won_index')); ?>"><i class="fa fa-circle-o text-aqua"></i> Won Clients</a></li>
                <li <?php echo e((url()->current()=='http://127.0.0.1:8000/lost_index' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/lost_index')); ?>"><i class="fa fa-circle-o text-aqua"></i> Lost Clients</a></li>        
              </ul>
            </li>

          </ul>
        </li>

        
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/sched' ? 'class=active' : '')); ?>>
          <a href="<?php echo e(url('/sched')); ?>" >
            <i class="fa fa-star text-red"></i> <span class="side-b">Employee Schedule</span>
          </a>
        </li>


        <?php } ?>

        <?php if(session()->get('user_level') != 'Client'){ ?>
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/dtr' ? 'class=active' : '')); ?>>
          <a href="<?php echo e(url('/dtr')); ?>" >
            <i class="fa fa-check text-red"></i> <span class="side-b">Attendance</span>
          </a>
        </li>
        <?php } ?>

        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/list_request' ? 'class=active' : '')); ?>>
          <a href="<?php echo e(url('/list_request')); ?>" >
            <i class="fa fa-plane text-yellow"></i> <span class="side-b">Leave Requests</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right" title="requests"><?php echo e($requestscount); ?></span>
            </span>
          </a>
        </li>

          <?php if(url()->current()=='http://127.0.0.1:8000/menus'
                || url()->current()=='http://127.0.0.1:8000/contents'
                || url()->current()=='http://127.0.0.1:8000/page'
                || url()->current()=='http://127.0.0.1:8000/newsfeeds'): ?>
          <li class="active treeview">
          <?php else: ?>
          <li class="treeview">
          <?php endif; ?>
          <a href="#">
            <i class="fa fa-tv text-red"></i>
            <span class="side-b">Frontend</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(session()->get('user_level') == 'Admin' ): ?>
              <li <?php echo e((url()->current()=='http://127.0.0.1:8000/menus' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/menus')); ?>"><i class="fa fa-circle-o text-aqua"></i> Menus</a></li>
              <li <?php echo e((url()->current()=='http://127.0.0.1:8000/contents' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/contents')); ?>"><i class="fa fa-circle-o text-aqua"></i> Contents</a></li>
              <li <?php echo e((url()->current()=='http://127.0.0.1:8000/page' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/page')); ?>"><i class="fa fa-circle-o text-aqua"></i> Page</a></li>
            <?php elseif(session()->get('user_level') == 'Human Resource'): ?>
              <li <?php echo e((url()->current()=='http://127.0.0.1:8000/newsfeeds' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/newsfeeds')); ?>"><i class="fa fa-circle-o text-aqua"></i> Newsfeeds</a></li>
            <?php endif; ?>
          </ul>
        </li>

          <?php if(url()->current()=='http://127.0.0.1:8000/timedoctor'
                || url()->current()=='http://127.0.0.1:8000/invoices'
                || url()->current()=='http://127.0.0.1:8000/logs'): ?>
          <li class="active treeview">
          <?php else: ?>
          <li class="treeview">
          <?php endif; ?>
          <a href="#">
            <i class="fa fa-th-list text-aqua"></i>
            <span class="side-b">Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/timedoctor' ? 'class=active' : '')); ?>>
              <a href="<?php echo e(url('/timedoctor')); ?>" >
                <i class="fa fa-circle-o text-aqua"></i> Daily Time Record</span>
              </a>
            </li>
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/invoices' ? 'class=active' : '')); ?>><a href="/invoices"><i class="fa fa-circle-o text-aqua"></i> Invoice</a></li>
            <li <?php echo e((url()->current()=='http://127.0.0.1:8000/logs' ? 'class=active' : '')); ?>><a href="/logs"><i class="fa fa-circle-o text-aqua"></i> Logs</a></li>
          </ul>
        </li>
        <?php } ?>
        <li <?php echo e((url()->current()=='http://127.0.0.1:8000/admin/active-users' ? 'class=active' : '')); ?>><a href="<?php echo e(url('/admin/active-users')); ?>"><i class="fa fa-bar-chart-o text-aqua"></i> <span class="side-b">Users Status</span></a></li>
        <!-- <li <?php echo e((url()->current()=='http://127.0.0.1:8000/documentation' ? 'class=active' : '')); ?>><a href="/documentation"><i class="fa fa-book"></i> <span class="side-b">Documentation</span></a></li> -->
        <?php if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'): ?>
        <br><br><br><br><br><br><br><br><br><br>
        <?php elseif(Auth::user()->user_level == 'Client'): ?>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php else: ?>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php endif; ?>
        <!-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  