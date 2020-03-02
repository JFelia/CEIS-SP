
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Add Interval</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Categories</a></li>
        <li class="active">Add Interval</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Schedule Information</h3>
            </div>
            <form role="form" action="{{url('/update_special',[$schedDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$schedDetails->category_name}}" disabled>
                </div>
                <div class="form-group">
                  <label>Interval</label>
                  <div class="row">
                    <div class="col-md-6">
                      <label># Days In</label>
                      <input type="number" class="form-control" name="in" value="{{$schedDetails->working_days}}">
                    </div>
                    <div class="col-md-6">
                      <label># Days Out</label>
                      <input type="number" class="form-control" name="out" value="{{$schedDetails->day_off}}">
                    </div>
                  </div>
                  
                </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection