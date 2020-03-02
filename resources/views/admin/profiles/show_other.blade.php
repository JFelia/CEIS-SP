@extends('layouts.adminLayout.admin_design')
@section('content')



<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Profile</li>
      </ol>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">
              @if($staffDetails->avatar != 'default_user.png')
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/small/{{$staffDetails->avatar}}" alt="User profile picture">
              @else
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/default_user.png" alt="User profile picture">
              @endif

              <h3 class="profile-username text-center">{{$staffDetails->name}}</h3>

              <p class="text-muted text-center">{{$staffDetails->user_level}}</p>
              @if($staffDetails->status == 1)
              <p class="text-center"><i class="fa fa-circle text-success"></i> Online</p>
              @else
              <p class="text-center"><i class="fa fa-circle text-fail"></i> Offline</p>
              @endif

              <!-- <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>SMS Sent</b> <a class="pull-right">{{$smssent}}</a>
                </li>
              </ul> -->
            </div>
           
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            
            <div class="box-body">
              <strong><i class="fa fa-birthday-cake margin-r-5"></i> Birthday</strong>

              <p class="text-muted">
              <?php 
               $birthdate = $staffDetails->bday_year."-".$staffDetails->birthday;
              ?>
              {{date('F d, Y', strtotime($birthdate))}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              <p class="text-muted">
                {{$staffDetails->educ}}
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
              <p class="text-muted">{{$staffDetails->address}} {{$staffDetails->city}} {{$staffDetails->state}} {{$staffDetails->country}}</p>
              
            </div>
          </div>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="glyphicon glyphicon-chevron-up"></i></button>
        
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- <div class="box-body">
                <form method="POST" action="{{route('posts.store')}}">
                    {{csrf_field()}}
                      @if(Auth::user()->avatar == 'default_user.png')
                      <img class="direct-chat-img" src="/LTE/dist/img/{{Auth::user()->avatar}}" alt="message user image">
                      @else
                      <img class="direct-chat-img" src="/LTE/dist/img/small/{{Auth::user()->avatar}}" alt="message user image">
                      @endif
                      <div class="direct-chat-text">
                      <input type="text" name="message" id="myemoji" placeholder="Write something . . ." class="form-control" autocomplete="off">
                      </div> 
                      <br>
                    <div class="pull-right">
                      
                      <button type="submit" class="btn btn-warning btn-flat"> Post</button>
                   
                    </div>
                  </form>
                </div>
                <hr> -->
                 <div class="post">
                  @foreach($posts as $allpost)                  
                  <br>
                  <div class="user-block">
                    @if($allpost->poserAvatar == 'default_user.png')
                    <img class="img-circle img-bordered-sm" src="/LTE/dist/img/{{$allpost->poserAvatar}}" alt="user image">
                    @else
                    <img class="img-circle img-bordered-sm" src="/LTE/dist/img/small/{{$allpost->poserAvatar}}" alt="user image">
                    @endif
                        <span class="username">
                          <a href="" style="font-size: 12px;">{{$allpost->poser}}</a>
                          @if($allpost->user_id == Auth::user()->id)
                          <a href="" ></a>
                          <a href="{{url('/posts/delete-post',[$allpost->id])}}" class="pull-right btn-box-tool" title="delete" onclick="return confirm('Are you sure you want to delete this post?')" ><i class="fa fa-times"></i></a>
                          @endif
                        </span>
                    <span class="description" style="font-size: 11px;">Posted on - {{date('F d, Y - h:i:sa',strtotime($allpost->poserCreated_at))}}</span>
                  </div>
                  <p>{{$allpost->message}}</p>
                  @if($allpost->avatar != '')
                  <center>
                  <img class="img-responsive pad" src="/LTE/dist/img/medium/{{$allpost->avatar}}" alt="Photo">
                  </center>
                  @endif
                  <!-- <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        </a></li>
                  </ul> -->
                  <p style="font-size:12px;">{{$allpost->comments_count}}
                  <?php
                    if($allpost->comments_count > 1){
                      echo 'comments';
                    }else{
                      echo 'comment';
                    }?> 
                    <i class="fa fa-comment-o"></i>
                  </p>
                    @foreach($allpost->comment as $objects)
                    <div class="box-footer box-comments">
                      <div class="box-comment">
                        @if($objects->avatar == 'default_user.png')
                        <img class="img-circle img-sm" src="/LTE/dist/img/{{$objects->avatar}}" alt="User Image">
                        @else
                        <img class="img-circle img-sm" src="/LTE/dist/img/small/{{$objects->avatar}}" alt="User Image">
                        @endif
                        
                        <div class="comment-text">
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
                    <hr>
                  <!-- for division -->
                    <div class="box-footer box-comments">
                      <div class="box-comment">
                        <div class="comment-text">
                              <span class="username">
                              </span>
                        </div>
                      </div>
                    </div>
                    <!-- end of division -->
                  @endforeach
                  <center>{{$posts->links()}}</center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>




@endsection