<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::user()->avatar != 'default_user.png')
          <img src="/LTE/dist/img/small/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
          @else
          <img src="/LTE/dist/img/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
          @endif
          
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
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
        <li {{{(url()->current()=='http://127.0.0.1:8000/admin/dashboard' ? 'class=active' : '')}}}>
          <a href="{{url('/admin/dashboard')}}" >
            <i class="fa fa-home text-aqua"></i> <span class="side-b">Home</span>
          </a>
        </li>
        <?php if(session()->get('user_level') != 'Client'){ ?>
        <li {{{(url()->current()=='http://127.0.0.1:8000/profile' ? 'class=active' : '')}}}><a href="{{url('profile')}}"><i class="fa fa-user text-aqua"></i> <span class="side-b">Profile</span></a></li>
        <?php }else{ ?>
            @if(url()->current()=='http://127.0.0.1:8000/clients/client-profile/'.Auth::user()->id)
              <li class="active">
            @else
              <li>
            @endif
              <a href="{{url('/clients/client-profile',Auth::user()->id)}}"><i class="fa fa-user text-aqua"></i> <span class="side-b">Profile</span></a></li>
        <?php } ?>

          @if(url()->current()=='http://127.0.0.1:8000/messages/create'
            || url()->current()=='http://127.0.0.1:8000/messages'
            || url()->current()=='http://127.0.0.1:8000/emails'
            || url()->current()=='http://127.0.0.1:8000/viewgetintouch')
          <li class="active treeview">
          @else
          <li class="treeview">
          @endif
          <a href="#">
            <i class="fa fa-envelope text-yellow"></i>
            <span class="side-b">Messages</span>
            <span class="pull-right-container">
              @if(Auth::user()->user_level != 'Client')
              <span class="label label-danger pull-right" title="get in touch">{{$getintouch}}</span>
              @endif
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{(url()->current()=='http://127.0.0.1:8000/messages/create' ? 'class=active' : '')}}}><a href="{{route('messages.create')}}"><i class="fa fa-circle-o text-aqua"></i> Compose SMS</a></li>
            <li {{{(url()->current()=='http://127.0.0.1:8000/messages' ? 'class=active' : '')}}}><a href="{{route('messages.index')}}"><i class="fa fa-circle-o text-aqua"></i> Sent Items</a></li>
            @if(Auth::user()->user_level != 'Client')
            <li {{{(url()->current()=='http://127.0.0.1:8000/viewgetintouch' ? 'class=active' : '')}}}>
              <a href="{{url('/viewgetintouch')}}"><i class="fa fa-circle-o text-aqua"></i> Get in touch
                <span class="pull-right-container">
                    <span class="label label-danger pull-right" title="get in touch">{{$getintouch}}</span>
                  </span>
              </a>
            </li>
            @endif
          </ul>
        </li>
        
        
        
        
        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
          @if(url()->current()=='http://127.0.0.1:8000/user_roles'
            || url()->current()=='http://127.0.0.1:8000/type_of_leave')
          <li class="active treeview">
          @else
          <li class="treeview">
          @endif
          <a href="#">
            <i class="fa fa-list text-red"></i>
            <span class="side-b">Dynamic Data Center</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li {{{(url()->current()=='http://127.0.0.1:8000/user_roles' ? 'class=active' : '')}}}>
                  <a href="{{url('/user_roles')}}" >
                    <i class="fa fa-circle-o text-aqua"></i> User Roles
                  </a>
                </li>
                <li {{{(url()->current()=='http://127.0.0.1:8000/type_of_leave' ? 'class=active' : '')}}}>
                  <a href="{{url('/type_of_leave')}}" >
                    <i class="fa fa-circle-o text-aqua"></i> Type of Leave
                  </a>
                </li>
                
              </ul>
        </li>
        <?php } ?>

        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
          @if(url()->current()=='http://127.0.0.1:8000/files'
            || url()->current()=='http://127.0.0.1:8000/admin/addstaff'
            || url()->current()=='http://127.0.0.1:8000/admin/staffs'
            || url()->current()=='http://127.0.0.1:8000/clients/create'
            || url()->current()=='http://127.0.0.1:8000/clients'
            || url()->current()=='http://127.0.0.1:8000/won_index'
            || url()->current()=='http://127.0.0.1:8000/lost_index')
          <li class="active treeview">
          @else
          <li class="treeview">
          @endif
          <a href="#">
            <i class="fa fa-group text-aqua"></i>
            <span class="side-b">People</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li {{{(url()->current()=='http://127.0.0.1:8000/files' ? 'class=active' : '')}}}><a href="{{route('files.index')}}"><i class="fa fa-circle-o text-aqua"></i> Applicants</a></li>
            @if(url()->current()=='http://127.0.0.1:8000/admin/addstaff'
              || url()->current()=='http://127.0.0.1:8000/admin/staffs')
            <li class="active treeview">
            @else
            <li class="treeview">
            @endif
              <a href="#"><i class="fa fa-circle-o text-aqua"></i> Employees
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li {{{(url()->current()=='http://127.0.0.1:8000/admin/addstaff' ? 'class=active' : '')}}}><a href="{{url('/admin/addstaff')}}"><i class="fa fa-circle-o text-aqua"></i> Add Employee</a></li>
                <li {{{(url()->current()=='http://127.0.0.1:8000/admin/staffs' ? 'class=active' : '')}}}><a href="{{url('/admin/staffs')}}"><i class="fa fa-circle-o text-aqua"></i> View Employees</a></li>
              </ul>
            </li>
            @if(url()->current()=='http://127.0.0.1:8000/clients/create'
              || url()->current()=='http://127.0.0.1:8000/clients'
              || url()->current()=='http://127.0.0.1:8000/won_index'
              || url()->current()=='http://127.0.0.1:8000/lost_index')
            <li class="active treeview">
            @else
            <li class="treeview">
            @endif
              <a href="#"><i class="fa fa-circle-o text-aqua"></i> Clients
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li {{{(url()->current()=='http://127.0.0.1:8000/clients/create' ? 'class=active' : '')}}}><a href="{{route('clients.create')}}"><i class="fa fa-circle-o text-aqua"></i> Add Prospect Client</a></li>
                <li {{{(url()->current()=='http://127.0.0.1:8000/clients' ? 'class=active' : '')}}}><a href="{{route('clients.index')}}"><i class="fa fa-circle-o text-aqua"></i> View Prospect Clients</a></li>
                <li {{{(url()->current()=='http://127.0.0.1:8000/won_index' ? 'class=active' : '')}}}><a href="{{url('/won_index')}}"><i class="fa fa-circle-o text-aqua"></i> Won Clients</a></li>
                <li {{{(url()->current()=='http://127.0.0.1:8000/lost_index' ? 'class=active' : '')}}}><a href="{{url('/lost_index')}}"><i class="fa fa-circle-o text-aqua"></i> Lost Clients</a></li>        
              </ul>
            </li>

          </ul>
        </li>

        
        <li {{{(url()->current()=='http://127.0.0.1:8000/sched' ? 'class=active' : '')}}}>
          <a href="{{url('/sched')}}" >
            <i class="fa fa-star text-red"></i> <span class="side-b">Employee Schedule</span>
          </a>
        </li>


        <?php } ?>

        <?php if(session()->get('user_level') != 'Client'){ ?>
        <li {{{(url()->current()=='http://127.0.0.1:8000/dtr' ? 'class=active' : '')}}}>
          <a href="{{url('/dtr')}}" >
            <i class="fa fa-check text-red"></i> <span class="side-b">Attendance</span>
          </a>
        </li>
        <?php } ?>

        <?php if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource'){ ?>
        <li {{{(url()->current()=='http://127.0.0.1:8000/list_request' ? 'class=active' : '')}}}>
          <a href="{{url('/list_request')}}" >
            <i class="fa fa-plane text-yellow"></i> <span class="side-b">Leave Requests</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right" title="requests">{{$requestscount}}</span>
            </span>
          </a>
        </li>

          @if(url()->current()=='http://127.0.0.1:8000/menus'
                || url()->current()=='http://127.0.0.1:8000/contents'
                || url()->current()=='http://127.0.0.1:8000/page'
                || url()->current()=='http://127.0.0.1:8000/newsfeeds')
          <li class="active treeview">
          @else
          <li class="treeview">
          @endif
          <a href="#">
            <i class="fa fa-tv text-red"></i>
            <span class="side-b">Frontend</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(session()->get('user_level') == 'Admin' )
              <li {{{(url()->current()=='http://127.0.0.1:8000/menus' ? 'class=active' : '')}}}><a href="{{url('/menus')}}"><i class="fa fa-circle-o text-aqua"></i> Menus</a></li>
              <li {{{(url()->current()=='http://127.0.0.1:8000/contents' ? 'class=active' : '')}}}><a href="{{url('/contents')}}"><i class="fa fa-circle-o text-aqua"></i> Contents</a></li>
              <li {{{(url()->current()=='http://127.0.0.1:8000/page' ? 'class=active' : '')}}}><a href="{{url('/page')}}"><i class="fa fa-circle-o text-aqua"></i> Page</a></li>
            @elseif(session()->get('user_level') == 'Human Resource')
              <li {{{(url()->current()=='http://127.0.0.1:8000/newsfeeds' ? 'class=active' : '')}}}><a href="{{url('/newsfeeds')}}"><i class="fa fa-circle-o text-aqua"></i> Newsfeeds</a></li>
            @endif
          </ul>
        </li>

          @if(url()->current()=='http://127.0.0.1:8000/timedoctor'
                || url()->current()=='http://127.0.0.1:8000/invoices'
                || url()->current()=='http://127.0.0.1:8000/logs')
          <li class="active treeview">
          @else
          <li class="treeview">
          @endif
          <a href="#">
            <i class="fa fa-th-list text-aqua"></i>
            <span class="side-b">Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{(url()->current()=='http://127.0.0.1:8000/timedoctor' ? 'class=active' : '')}}}>
              <a href="{{url('/timedoctor')}}" >
                <i class="fa fa-circle-o text-aqua"></i> Daily Time Record</span>
              </a>
            </li>
            <li {{{(url()->current()=='http://127.0.0.1:8000/invoices' ? 'class=active' : '')}}}><a href="/invoices"><i class="fa fa-circle-o text-aqua"></i> Invoice</a></li>
            <li {{{(url()->current()=='http://127.0.0.1:8000/logs' ? 'class=active' : '')}}}><a href="/logs"><i class="fa fa-circle-o text-aqua"></i> Logs</a></li>
          </ul>
        </li>
        <?php } ?>
        <li {{{(url()->current()=='http://127.0.0.1:8000/admin/active-users' ? 'class=active' : '')}}}><a href="{{url('/admin/active-users')}}"><i class="fa fa-bar-chart-o text-aqua"></i> <span class="side-b">Users Status</span></a></li>
        <!-- <li {{{(url()->current()=='http://127.0.0.1:8000/documentation' ? 'class=active' : '')}}}><a href="/documentation"><i class="fa fa-book"></i> <span class="side-b">Documentation</span></a></li> -->
        @if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource')
        <br><br><br><br><br><br><br><br><br><br>
        @elseif(Auth::user()->user_level == 'Client')
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        @else
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        @endif
        <!-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  