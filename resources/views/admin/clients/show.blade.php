@extends('layouts.adminLayout.admin_design')
@section('content')



<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Client Profile</li>
      </ol>
    </section>

    
    <section class="content">

      <div class="row">
        <div class="col-md-3">

    
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if($clientDetails->avatar == 'default_user.png')
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/{{$clientDetails->avatar }}" alt="User profile picture">
              @else
              <img class="profile-user-img img-responsive img-circle" src="/LTE/dist/img/small/{{$clientDetails->avatar }}" alt="User profile picture">
              @endif
              <h3 class="profile-username text-center">{{$clientDetails->name}}</h3>

              <p class="text-muted text-center">{{$clientDetails->contact_number}}</p>

              @if($clientDetails->id == session()->get('user_id'))
              <a href="/invoices" class="btn btn-info btn-block"><b>Check Invoice</b></a>
              @endif
             
              @if($clientDetails->id == session()->get('user_id'))
                <button type="button" data-toggle="modal" data-target="#modal-update-profile-pic" class="btn btn-primary btn-block">Change Profile</button>
              @endif
            </div>
          </div>
         
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              @if($clientDetails->id == session()->get('user_id'))
              <li><a href="#settings" data-toggle="tab">Personal Information</a></li>
              <li><a href="#cpass" data-toggle="tab">Change Password</a></li>
              @endif
              @if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource' || session()->get('user_level') == 'Client')
              <li><a href="#contacts" data-toggle="tab">Contacts</a></li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                
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
                  <p>{{$allpost->message}}</p>
                  @if($allpost->avatar != '')
                  <center>
                  <img class="img-responsive pad" src="/LTE/dist/img/medium/{{$allpost->avatar}}" alt="Photo">
                  </center>
                  @endif
                 
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
                                <p style="font-size: 11px">{{$objects->commentor}}
                                <span class="text-muted pull-right" style="font-size: 11px">{{date('F d, Y - h:i:sa',strtotime($objects->created_at))}}</span>
                                </p>
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
                  @endforeach
                  <center>{{$posts->links()}}</center>
                </div>
              </div>
              @if($clientDetails->id == session()->get('user_id'))
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" role="form" action="{{route('clients.update',[$clientDetails->id])}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Name" value="{{Auth::user()->name}}" name="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Person</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Contact Person" value="{{Auth::user()->contact_person}}" name="contact_person">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="contact_number" value="{{Auth::user()->contact_number}}" name="contact_number">
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
                      <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>

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
                    <label class="col-sm-2 control-label">State</label>

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
                    <label class="col-sm-2 control-label">Zip</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Zip" value="{{Auth::user()->zip}}" name="zip">
                    </div>
                  </div>
                  
                  <input type="hidden" class="form-control" name="password" value="{{Auth::user()->password}}">
                  <input type="hidden" class="form-control" name="user_level" value="{{Auth::user()->user_level}}">
                  <input type="hidden" class="form-control" name="client_code" value="{{Auth::user()->client_code}}">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                     
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <div class="tab-pane" id="cpass">
              
                <div class="post">
                    <form class="form-horizontal" role="form" action="{{url('/admin/update-pwd')}}" method="post">
                      {{csrf_field()}}
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Current Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Type your current password" name="current_pwd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">New Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Type the new password you wish" name="new_pwd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Re-type New Password</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="Re-type the new password you wish" name="confirm_pwd">
                        </div>
                      </div>
                      <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                    </form>
                </div>
                
              </div>
              @endif
              <div class="tab-pane" id="contacts">
                <div class="post">
                  
                <div class="mailbox-controls">
                
                <button type="button" data-toggle="modal" data-target="#modal-add-contact" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
              </div>
              <div class="table-responsive mailbox-messages">
                <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Contact</th>
                  @if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource' || session()->get('user_level') == 'Client')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($contacts as $object)
                <tr>
                  <td class="mailbox-star"><a href="#"></a>  {{$c}}</td>
                  <td><a href="/contacts/{{$object->id}}" title="view" ><span class="icon"><i class="icon-eye-open"></i> </span>&nbsp&nbsp&nbsp</a>{{$object->name}}</td>
                  <td>{{$object->contact_no}}</td>
                  @if(session()->get('user_level') == 'Admin' || session()->get('user_level') == 'Human Resource' || session()->get('user_level') == 'Client')
                  <td style="text-align:center">
                      <a href="/contacts/{{$object->id}}/edit" class="btn btn-info btn-xs" title="edit"><span class="fa fa-pencil"></span></a>
                  </td>
                  @endif
                </tr>
                <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
      </section>

<!-- this modal is for adding client's contacts -->
<div class="modal modal-primary fade" id="modal-add-contact">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Contacts</h4>
              </div>
             <form role="form" action="{{route('contacts.store')}}" method="post">
            {{csrf_field()}}
              <div class="modal-body">
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" required autocomplete="off">
                  <input type="text" name="contact" class="form-control" placeholder="Enter Number w/ Country Code" required autocomplete="off">
                <input type="hidden" name="client_id" value="{{$clientDetails->id}}">
                <input type="hidden" name="client_code" value="{{$clientDetails->client_code}}">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
              
            </form>
            </div>
          </div>
        </div>


@endsection