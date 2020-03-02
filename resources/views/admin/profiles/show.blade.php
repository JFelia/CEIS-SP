@extends('layouts.adminLayout.admin_design')
@section('content')



<section class="content-header">
      <h1>
        Profile
        <button type="button" data-toggle="modal" data-target="#modal-profile-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">

              @if(Auth::user()->avatar != 'default_user.png')
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/small/{{Auth::user()->avatar}}" alt="User profile picture">
              @else
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/{{Auth::user()->avatar}}" alt="User profile picture">
              @endif

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->user_level}}</p>

              <!-- <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>SMS Sent</b> <a class="pull-right">{{$smssent}}</a>
                </li>
              </ul> -->
              
                <button type="button" data-toggle="modal" data-target="#modal-update-profile-pic" class="btn btn-primary btn-block">Change Profile</button>
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
               $birthdate = Auth::user()->bday_year."-".Auth::user()->birthday;
              ?>
              {{date('F d, Y', strtotime($birthdate))}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
              {{Auth::user()->educ}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">{{session()->get('address')}} {{session()->get('city')}} {{session()->get('state')}} {{session()->get('country')}}</p>

              
            </div>
           
          </div>
          
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="glyphicon glyphicon-chevron-up"></i></button>
        
        <div class="col-md-9">
          <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#settings" data-toggle="tab">Personal Information</a></li>
              <li><a href="#cpass" data-toggle="tab">Change Password</a></li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                <!-- Post -->
                <div class="post">
                  @foreach($posts as $allpost)                 
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
                    <span class="description" style="font-size: 11px;">{{$allpost->remarks}} on - {{date('F d, Y - h:i:sa',strtotime($allpost->poserCreated_at))}}</span>
                  </div>
                  <p style="word-wrap: break-word;">{{$allpost->message}}</p>
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

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" role="form" action="{{url('/admin/edit-staff',[session()->get('user_id')])}}" method="post">
                {{csrf_field()}}
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Name" value="{{Auth::user()->name}}" name="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Extension1</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Extension1" value="{{Auth::user()->extension1}}" name="ext1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Extension2</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Extension2" value="{{Auth::user()->extension2}}" name="ext2">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Extension3</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Extension3" value="{{Auth::user()->extension3}}" name="ext3">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Username" value="{{Auth::user()->username}}" name="username" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" name="email" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" placeholder="Phone" value="{{Auth::user()->telephone}}" name="telephone" maxlength="11">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Skype</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Skype" value="{{Auth::user()->skype}}" name="skype">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">House No., Street</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Address" value="{{Auth::user()->address}}" name="address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="City" value="{{Auth::user()->city}}" name="city">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Region/State</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="State" value="{{Auth::user()->state}}" name="state">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Country</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Country" value="{{Auth::user()->country}}" name="country">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Zip Code</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" placeholder="Zip" value="{{Auth::user()->zip}}" name="zip">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Education</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Highest Educational Attainment" value="{{Auth::user()->educ}}" name="educ">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="password" value="{{Auth::user()->password}}">
                  <input type="hidden" class="form-control" name="user_level" value="{{Auth::user()->user_level}}">
                  <input type="hidden" class="form-control" name="birthday" value="{{Auth::user()->birthday}}">
                  <input type="hidden" class="form-control" name="bday_year" value="{{Auth::user()->bday_year}}">
                  <input type="hidden" class="form-control" name="anniversary" value="{{Auth::user()->anniversary}}">
                  <input type="hidden" class="form-control" name="anniv_year" value="{{Auth::user()->anniv_year}}">
                  <!-- <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Apply Changes</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <div class="tab-pane" id="cpass">
              
                <div class="post">
                    <form class="form-horizontal" role="form" action="{{url('/admin/update-pwd')}}" method="post">
                      {{csrf_field()}}
                      <div class="form-group{{$errors->has('current_pwd')?' has-error' : ''}}">
                        <label class="col-sm-2 control-label">Current Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Type your current password" name="current_pwd" required value="{{old('current_pwd')}}">
                          {!! $errors->first('current_pwd','<span class="help-block">:message</span>') !!}
                        </div>
                        
                      </div>
                      <div class="form-group{{$errors->has('new_pwd')?' has-error' : ''}}">
                        <label class="col-sm-2 control-label">New Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Type the new password you wish" name="new_pwd" required value="{{old('new_pwd')}}">
                          {!! $errors->first('new_pwd','<span class="help-block">:message</span>') !!}
                        </div>
                        
                      </div>
                      <div class="form-group{{$errors->has('confirm_pwd')?' has-error' : ''}}">
                        <label class="col-sm-2 control-label">Re-type New Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Re-type the new password you wish" name="confirm_pwd" required value="{{old('confirm_pwd')}}">
                          {!! $errors->first('confirm_pwd','<span class="help-block">:message</span>') !!}
                        </div>
                        
                      </div>
                      <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Apply Changes</button>
                    </div>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </section>



@endsection