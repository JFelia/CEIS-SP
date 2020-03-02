@extends('layouts.adminLayout.admin_design')
@section('content')
  
    <section class="content-header">
      <h1>
        Home
        
      
        
        <button type="button" data-toggle="modal" data-target="#modal-dashboard-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>

    </section>

  
    <section class="content">
  
      <div class="row">
        
        <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <p style="font-size: 15px" class="box-title"><span class="fa fa-pencil"></span></p> Status 
             
              
            </div>
              <div class="box-body">
                  <form method="POST" action="{{route('posts.store')}}">
                    {{csrf_field()}}
                      @if(Auth::user()->avatar == 'default_user.png')
                      <img class="direct-chat-img" src="/LTE/dist/img/{{Auth::user()->avatar}}" alt="message user image">
                      @else
                      <img class="direct-chat-img" src="/LTE/dist/img/small/{{Auth::user()->avatar}}" alt="message user image">
                      @endif
                      <div class="direct-chat-text">
                      <input id='myemoji' type="text" name="message" placeholder="Write something . . ." class="form-control" autocomplete="off">
                      </div>
                      {!! $errors->first('message','<p class="alert alert-danger">:message</p>') !!} 
                      <br>
                    <div class="pull-right">
                      
                      <button type="submit" class="btn btn-warning btn-flat"> Post</button>
                   
                  </div>
                  </form>
              </div>
          </div>
          @foreach($posts as $allpost)
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                @if($allpost->poserAvatar == 'default_user.png')
                    <img class="img-circle" src="/LTE/dist/img/{{$allpost->poserAvatar}}" alt="user image">
                    @else
                    <img class="img-circle" src="/LTE/dist/img/small/{{$allpost->poserAvatar}}" alt="user image">
                    @endif

                @if($allpost->poser == session()->get('name') && $allpost->poserLevel == 'Client')
                  <!-- if the post is the user's post and user level is client-->
                  <span class="username" style="font-size: 12px"><a href="{{url('/clients/client-profile',[$allpost->poserID])}}">{{$allpost->poser}}</a></span>
                @elseif($allpost->poser == session()->get('name'))
                  <!-- if the poser is the user itself -->
                  <span class="username" style="font-size: 12px"><a href="{{url('profile')}}">{{$allpost->poser}}</a></span>
                @elseif($allpost->poserLevel == 'Client')
                  <!-- if the poser is a client -->
                  <span class="username" style="font-size: 12px"><a href="{{url('/clients/client-profile',[$allpost->poserID])}}">{{$allpost->poser}}</a></span>
                @else
                  <!-- if the poser is not client and not the user -->
                  <span class="username" style="font-size: 12px"><a href="{{url('/admin/staff-profile',[$allpost->poserID])}}">{{$allpost->poser}}</a></span>
                @endif

                <span class="description" style="font-size: 11px">{{$allpost->remarks}} on - {{date('F d, Y - h:i:sa, l',strtotime($allpost->poserCreated_at))}}</span>
              </div>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                @if($allpost->user_id == Auth::user()->id || Auth::user()->user_level == 'Admin')
                  <a href="{{url('/posts/delete-post',[$allpost->id])}}" class="pull-right btn-box-tool" title="delete" onclick="return confirm('Are you sure you want to delete this post?')" ><i class="fa fa-times"></i></a>
                  @endif
              </div>
            </div> 
            <div class="box-body">
              <p style="word-wrap: break-word;">{{$allpost->message}}</p>
              @if($allpost->avatar != '')
              <center>
                
                  <img class="img-responsive pad" src="/LTE/dist/img/medium/{{$allpost->avatar}}" id="myImg" alt="Photo">
               
              </center>
              @endif
             
              <span class="pull-right text-muted" style="font-size: 12px">{{$allpost->comments_count}}
              <?php
                if($allpost->comments_count > 1){
                  echo 'comments';
                }else{
                  echo 'comment';
                }?> 
                <i class="fa fa-comment-o"></i></span>
            </div>
            @foreach($allpost->comment as $objects)
            <div class="box-footer box-comments">
              <div class="box-comment">
                @if($objects->avatar == 'default_user.png')
                <img class="img-circle img-sm" src="/LTE/dist/img/{{$objects->avatar}}" alt="User Image">
                @else
                <img class="img-circle img-sm" src="/LTE/dist/img/small/{{$objects->avatar}}" alt="User Image">
                @endif
                
                <div class="comment-text" style="word-wrap: break-word;">
                      <span class="username">

                      @if($objects->commentor == session()->get('name') && session()->get('user_level') == 'Client')
                      <!-- if the post is the user's post and user level is client-->
                        <a href="{{url('/clients/client-profile',[$objects->user_id])}}" style="font-size: 11px">{{$objects->commentor}}
                      @elseif($objects->commentor == session()->get('name'))
                      <!-- if the poser is the user itself -->
                        <a href="{{url('profile')}}" style="font-size: 11px">{{$objects->commentor}}
                      @elseif($objects->client == '1')
                      <!-- if the poser is a client -->
                        <a href="{{url('/clients/client-profile',[$objects->user_id])}}" style="font-size: 11px">{{$objects->commentor}}
                      @else
                      <!-- if the poser is not client and not the user -->
                        <a href="{{url('/admin/staff-profile',[$objects->user_id])}}" style="font-size: 11px">{{$objects->commentor}}
                      @endif
                        <span class="text-muted pull-right" style="font-size: 11px">{{date('F d, Y - h:i:sa',strtotime($objects->created_at))}}</span>
                        </a>

                      </span>
                  <p style="font-size: 11px">{{$objects->message}}</p>
                </div>
              </div>
            </div>
            @endforeach
            <div class="box-footer">
              <form action="{{route('comments.store')}}" method="post">
                  {{csrf_field()}}
                    @if(Auth::user()->avatar == 'default_user.png')
                    <img class="img-responsive img-circle img-sm" src="/LTE/dist/img/{{Auth::user()->avatar}}" alt="user image">
                    @else
                    <img class="img-responsive img-circle img-sm" src="/LTE/dist/img/small/{{Auth::user()->avatar}}" alt="user image">
                    @endif
                <div class="img-push">
                  <!-- <input type="text" class="form-control input-sm" placeholder="Press enter to post comment" name="comment"> -->
                  <div class="input-group">
                      <input type="text" name="comment" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Comment</button>
                      </span>
                    <input type="hidden" name="post_id" value="{{$allpost->id}}">
                    <input type="hidden" name="posername" value="{{$allpost->poser}}">
                  </div>
                </div>
              </form>
            </div>
          </div>

          @endforeach
          <center>{{$posts->links()}}</center>
         
      </div>


      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" >
      @if(session()->get('user_level') != 'Client')
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$clients}}</h3>

              <p style="font-size: 12px;">Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            @if(Auth::user()->user_level == 'Admin')
            <a href="/won_index" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            @endif
          </div>
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$userscount}}</h3>

              <p style="font-size: 12px;">Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            @if(Auth::user()->user_level == 'Admin')
            <a href="/admin/staffs" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            @endif
          </div>
        
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$sent_items}}</h3>

              <p style="font-size: 12px;">Total Sent Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark"></i>
            </div>
            @if(Auth::user()->user_level == 'Admin')
            <a href="/messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            @endif
          </div>
         
          @endif
              <!-- USERS LIST -->
          @if(Auth::user()->user_level == 'Client')
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Recently Sent Items</h3>

                  <div class="box-tools pull-right">
                    <!-- <span class="label label-danger">{{$userscount}} New Members</span> -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="table-responsive mailbox-messages">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th>Recipients</th>
                      <th>Message</th>
                    </thead>
                    <tbody>
                    <?php $c = 0;
                      foreach($sents as $obj){
                        if($c != 5){
                     ?>
                      <tr>
                      <td><?php echo $obj->recipient; ?></td>
                      <td>{{$obj->message}}</td>
                      </tr>
                    <?php $c++;  }}?>
                    </tbody>
                  </table>
                  
                </div>

                
              
              </div>
              <!--/.box -->
              @endif

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php $c = 0;
                      foreach($users as $staffs){
                        if($c != 8){ ?>
                    <li>
                      @if($staffs->avatar == 'default_user.png')
                      <img src="/LTE/dist/img/{{$staffs->avatar}}" alt="User Image">
                      @else
                      <img src="/LTE/dist/img/small/{{$staffs->avatar}}" alt="User Image">
                      @endif
                      <a class="users-list-name">{{$staffs->name}}</a>
                      <span class="users-list-date">{{date('m/d/y',strtotime($staffs->created_at))}}</span>
                      
                    </li>
                    <?php $c++;  }}?>
                  </ul>
                  <!-- /.users-list -->
                </div>
               
              </div>
              <!--/.box -->

            </div>
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="glyphicon glyphicon-chevron-up"></i></button>
      </div>
      
    </section>

  @endsection




  