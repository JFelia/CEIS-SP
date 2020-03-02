@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>
        Edit Contact
      </h1>
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
              <h3 class="box-title">Contact Information</h3>
            </div>
        
            <form role="form" action="{{route('contacts.update',[$contacts->id])}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$contacts->name}}">
                </div>
                <div class="form-group">
                  <label>Contact No</label>
                  <input type="text" name="contact" class="form-control" placeholder="Enter Contact Number" value="{{$contacts->contact_no}}">
                </div>
                  <input type="hidden" name="client_id" value="{{$contacts->client_id}}">
                
                
              </div>
              

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          
          </section>

@endsection