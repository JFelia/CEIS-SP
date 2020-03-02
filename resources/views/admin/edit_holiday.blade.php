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
              <h3 class="box-title">Holiday Information</h3>
            </div>
            <form role="form" action="{{url('/admin/edit-holiday',[$holidayDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Description</label>
                  <input type="text" class="form-control" placeholder="Enter Description" name="description" value="{{$holidayDetails->description}}">
                </div>
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" class="form-control" placeholder="MM-DD" name="date" value="{{$holidayDetails->date}}">
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection