@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Conversation
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Staffs</a></li>
        <li class="active">View Staffs</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
       <div class="col-md-9">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              @foreach($email as $object)
                  @if($object->client_avatar != 'default_user.png')
                  <img class="direct-chat-img" src="/LTE/dist/img/small/{{$object->client_avatar}}" alt="message user image">
                  @else
                  <img class="direct-chat-img" src="/LTE/dist/img/{{$object->client_avatar}}" alt="message user image">
                  @endif
                  <p><b>&nbsp&nbsp{{$object->client_name}}</b> - <i>{{$object->recipients}}</i><span style=" font-size: 12px;color:#4dc3ff"> - {{date('F d, Y h:i:sa',strtotime($object->created_at))}}</span></p>
                  <p style="margin-left: 10px">~ {{$object->message}}</p>
                  @if(Auth::user()->user_level == 'Client')
                  <div class="box-tools">
                    <!-- <a href="{{url('/edit_email',[$object->id])}}" class="pull-right btn-box-tool" title="edit"><i class="fa fa-pencil"></i></a> -->
                    <button type="button" data-toggle="modal" data-target="#modal-edit_email" class="btn btn-primary btn-sm" title="edit"><i class="fa fa-pencil"></i></button>
                  </div>
                  @endif
              @endforeach

                
            </div>
              <div class="box-body">
              <b>Replies . . . </b><br><br>
               @foreach($replies as $object2)
                  @if($object2->user_avatar != 'default_user.png')
                  <img class="direct-chat-img" src="/LTE/dist/img/small/{{$object2->user_avatar}}" alt="message user image">
                  @else
                  <img class="direct-chat-img" src="/LTE/dist/img/{{$object2->user_avatar}}" alt="message user image">
                  @endif
                  <p style="margin-left: 10px"><b>&nbsp&nbsp{{$object2->user_name}}</b><span style="font-size: 12px;color:#4dc3ff"> - {{date('F d, Y h:i:sa',strtotime($object2->created_at))}}</span></p>
                  <p style="margin-left: 15px">~ {{$object2->message}}</p>
                  @if($object2->user_id == session()->get('user_id') && $object2->status != 'Mark as Read')
                  <p style="font-size: 12px;color:#4dc3ff;margin-left: 85%">{{$object2->status}}</p>
                  @elseif($object2->user_id != session()->get('user_id') && $object2->status == 'Mark as Read')
                  <p style="font-size: 12px;color:#4dc3ff;margin-left: 85%"><a href="{{url('replies/mark',[$object2->id])}}">Mark as Read</a></p>
                  
                  @endif
                @endforeach

                <form role="form" action="{{route('replies.store')}}" method="post">
                  {{csrf_field()}}
                      <div class="form-group">
                          <textarea placeholder="Start Conversation"
                                  style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="message"></textarea>
                      </div>
                      @foreach($email as $object)
                      <input type="hidden" name="email_id" value="{{$object->id}}">
                      <input type="hidden" name="client_id" value="{{$object->client_id}}">
                      @endforeach
                    </div>
                    <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                  </form>

              </div>
          </div>
      </div>
        <div class="col-md-3">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Help</h3>
            </div>
              <div class="box-body">
                <div class="box-body box-profile">
                    <p>You can see the <b>Main Email</b> at the top</p>
                    <p>with <b>Client name</b> - <b>Recipient</b></p>
                    <p>Below are the <b>Replies</b></p>
                    <p>Every replies should be <b>Mark as Read</b></p>
                    
                </div>
              </div>
            </div>
        </div>
      </div>
          <!-- /.box -->
  </section>
@endsection


<div class="modal modal-info fade" id="modal-edit_email">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Message</h4>
              </div>
              @foreach($email as $object)
              <form action="/update_email/{{$object->id}}" method="POST">
              <div class="modal-body" >
                  {{csrf_field()}}
                      <div class="form-group">
                          <label>Recipients (just leave one space for other recipient)</label>
                              <input type="text" name="recipients" class="form-control" placeholder="Recipients should be seperated by a whitespace" value="{{$object->recipients}}">
                      </div>
                      <div class="form-group">
                          <label>Message</label>
                              <textarea placeholder="Message"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;color:black;" name="message" >{{$object->message}}</textarea>
                      </div>
                      
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-cloud-upload"></i> Submit</button>
              </div>
              </form>
              @endforeach
            </div>
          </div>
        </div>