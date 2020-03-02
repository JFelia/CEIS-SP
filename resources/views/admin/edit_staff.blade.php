@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Edit Staff</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Staffs</a></li>
        <li><a href="#">View Staffs</a></li>
        <li class="active">Edit Staff</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Staff Information</h3>
            </div>
            <form role="form" action="{{url('/admin/edit-staff',[$staffDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{$staffDetails->name}}">
                </div>
                <div class="form-group">
                  <label>Extension 1</label>
                  <input type="text" class="form-control" placeholder="Enter Extension 1" name="ext1" value="{{$staffDetails->extension1}}">
                </div>
                <div class="form-group">
                  <label>Extension 2</label>
                  <input type="text" class="form-control" placeholder="Enter Extension 2" name="ext2" value="{{$staffDetails->extension2}}">
                </div>
                <div class="form-group">
                  <label>Extension 3</label>
                  <input type="text" class="form-control" placeholder="Enter Extension 3" name="ext3" value="{{$staffDetails->extension3}}">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Enter Username" name="username" value="{{$staffDetails->username}}" disabled>
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$staffDetails->email}}" disabled>
                </div>
                <div class="form-group">
                  <label>Telephone</label>
                  <input type="number" class="form-control" placeholder="Enter Telephone Number" name="telephone" value="{{$staffDetails->telephone}}">
                </div>
                <div class="form-group">
                  <label>Skype</label>
                  <input type="text" class="form-control" placeholder="Enter Skype Account" name="skype" value="{{$staffDetails->skype}}">
                </div>
                <div class="form-group">
                  <label>House No, Street</label>
                  <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{$staffDetails->address}}">
                </div>
                <div class="form-group">
                  <label>Region/State</label>
                  <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{$staffDetails->state}}">
                </div>
                <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{$staffDetails->city}}">
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{$staffDetails->country}}">
                </div>
                <div class="form-group">
                  <label>Zip</label>
                  <input type="number" class="form-control" placeholder="Enter Zip Code" name="zip" value="{{$staffDetails->zip}}">
                </div>
                <div class="form-group">
                  <label>Education</label>
                  <input type="text" class="form-control" placeholder="Enter Highest Educational Attainment" name="educ" value="{{$staffDetails->educ}}">
                </div>

                  <input type="hidden" class="form-control" name="password" value="{{$staffDetails->password}}">
                  <input type="hidden" class="form-control" name="user_level" value="{{$staffDetails->user_level}}">
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection