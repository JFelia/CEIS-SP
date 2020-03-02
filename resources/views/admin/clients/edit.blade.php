@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>
        Edit Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">View Clients</a></li>
        <li class="active">Edit Client</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Client Information</h3>
            </div>
            <form role="form" action="{{route('clients.update',[$clients->id])}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$clients->name}}">
                </div>
                <div class="form-group">
                  <label>Contact Person</label>
                  <input type="text" name="contact_person" class="form-control" value="{{$clients->contact_person}}">
                </div>
                <div class="form-group">
                  <label>Contact Number</label>
                  <input type="number" name="contact_number" class="form-control" value="{{$clients->contact_number}}">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" class="form-control" placeholder="Email" value="{{$clients->email}}">
                </div>
                <?php if($clients->type == 'prospect'){ ?>
                <div class="form-group">
                  <label>Inquiring by email or call by us</label>
                  <input type="text" name="email_or_call" class="form-control" placeholder="Email or Call" value="{{$clients->email_or_call}}">
                </div>
                <div class="form-group">
                  <label>Sales</label>
                  <input type="text" name="sales" class="form-control" placeholder="Sales" value="{{$clients->sales}}">
                </div>
                <div class="form-group">
                  <label>If not a sales; Why</label>
                  <textarea placeholder="Enter Reason"
                                      style="width: 100%; height: 60px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="IfNotSalesWhy">{{$clients->IfNotSalesWhy}}</textarea>
                </div>
                <div class="form-group">
                  <label>Updates from the clients</label>
                  <textarea placeholder="Enter Updates"
                                      style="width: 100%; height: 60px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="updates">{{$clients->updates}}</textarea>
                </div>
                <div class="form-group">
                  <label>Followed Up On</label>
                  <input type="date" name="FollowedUpOn" class="form-control" placeholder="YYYY-MM-DD" value="{{$clients->FollowedUpOn}}">
                </div>
                <?php }elseif($clients->type == 'win'){?>
                <div class="form-group">
                  <label>Service</label>
                  <input type="text" name="service" class="form-control" placeholder="Service" value="{{$clients->service}}">

                 
                </div>
                <div class="form-group">
                  <label>Rate per SMS</label>
                  <input type="text" name="rateperhour" class="form-control" placeholder="Rate" value="{{$clients->rateperhour}}">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Username" value="{{$clients->username}}">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" value="{{$clients->password}}">
                </div>
                <?php } ?>
                <input type="hidden" name="type" value="{{$clients->type}}">
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection