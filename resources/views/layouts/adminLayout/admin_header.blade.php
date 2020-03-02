<header class="main-header">
    <!-- Logo -->
    <a href="/admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Greymouse</b>Portal</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if(session()->get('user_level') != 'Client')
         
          <li class="dropdown messages-menu" title="Birthdays">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-birthday-cake" ></i>
              <span class="label label-success">{{$bdayscount}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">There's {{$bdayscount}} birthdays today</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                    foreach($celebrants as $object){
                  ?>

                  <li><!-- start message -->
                    @if($object->id == session()->get('user_id'))
                      <a href="{{url('profile')}}">
                    @else
                      <a href="{{url('/admin/staff-profile',[$object->id])}}">
                    @endif
                      <div class="pull-left">
                        @if($object->avatar != 'default_user.png')
                        <img src="/LTE/dist/img/small/{{$object->avatar}}" class="img-circle" alt="User Image">
                        @else
                        <img src="/LTE/dist/img/{{$object->avatar}}" class="img-circle" alt="User Image">
                        @endif
                      </div>
                      <h4>
                        @if($object->id == session()->get('user_id'))
                          {{'Today is your birthday'}}
                        @else
                          {{$object->name}}
                        @endif
                        <!-- <small><i class="fa fa-clock-o"></i> {{date('F d, Y',strtotime($object->created_at))}}</small> -->
                      </h4>
                      <!-- <p>{{$object->recipients}}</p>
                      <p>{{$object->message}}</p> -->
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="/birthdayboard">See Birthday Board</a></li>
            </ul>
          </li>
          <li class="dropdown messages-menu" title="Anniversary">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o" ></i>
              <span class="label label-success">{{$annivcount}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$annivcount}} membership anniversary</li>
              <li>
                
                <ul class="menu">
                  <?php
                    foreach($annivcelebrant as $object){
                  ?>

                  <li>
                    @if($object->id == session()->get('user_id'))
                      <a href="{{url('profile')}}">
                    @else
                      <a href="{{url('/admin/staff-profile',[$object->id])}}">
                    @endif
                      <div class="pull-left">
                        @if($object->avatar != 'default_user.png')
                        <img src="/LTE/dist/img/small/{{$object->avatar}}" class="img-circle" alt="User Image">
                        @else
                        <img src="/LTE/dist/img/{{$object->avatar}}" class="img-circle" alt="User Image">
                        @endif
                      </div>
                      <h4>
                        {{$object->name}}
                      </h4>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="/anniversaryboard">See Anniversary Board</a></li>
            </ul>
          </li>
          @endif
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user()->avatar != 'default_user.png')
              <img src="/LTE/dist/img/small/{{Auth::user()->avatar}}" class="user-image" alt="User Image">
              @else
              <img src="/LTE/dist/img/{{Auth::user()->avatar}}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              @if(Auth::user()->avatar != 'default_user.png')
              <img src="/LTE/dist/img/small/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
              @else
              <img src="/LTE/dist/img/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
              @endif
                

                <p>
                  {{Auth::user()->name}} - {{Auth::user()->user_level}}<br>
                  @if(session()->get('sched_start'))
                  {{session()->get('sched_start')}}:00  -  {{session()->get('sched_end')}}:00
                  @endif
                  <small>Since {{date('F d, Y',strtotime(Auth::user()->created_at))}}</small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  @if(session()->get('user_level') != 'Client')
                  <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                  @else
                  <a href="{{url('/clients/client-profile',session()->get('user_id'))}}" class="btn btn-default btn-flat">Profile</a>
                  @endif
                </div><div class="pull-right">
                  <!-- <a href="{{url('logout')}}" class="btn btn-default btn-flat">Lunch</a> -->
                  <a href="{{url('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         <!--  @if(session()->get('user_level') == 'super admin' || session()->get('user_level') == 'Admin')
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          @endif -->
        </ul>
      </div>
    </nav>
  </header>