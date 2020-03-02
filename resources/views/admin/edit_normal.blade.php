
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Add Dates</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Categories</a></li>
        <li class="active">Add Dates</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Schedule Information</h3>
            </div>
            <form role="form" action="{{url('/update_normal',[$schedDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$schedDetails->category_name}}" disabled>
                </div>
                <div class="form-group">
                  <label>Working Days</label>
                    <select class="form-control select2" multiple="multiple" name="days[]" data-placeholder="Days:" style="width: 100%;" >     
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                      <option value="Sunday">Sunday</option>
                    </select>
                </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection