
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Edit Leave</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Menus</a></li>
        <li class="active">Edit Leave</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Leave Information</h3>
            </div>
            <form role="form" action="{{url('/admin/edit-leave',[$leaveDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$leaveDetails->name}}">
                </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection