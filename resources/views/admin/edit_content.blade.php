
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Edit Content</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Contents</a></li>
        <li class="active">Edit Content</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Content Information</h3>
            </div>
            <form role="form" action="{{url('/admin/edit-content',[$ContentDetails->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="title" value="{{$ContentDetails->title}}">
                </div>
                <div class="form-group">
                  <label>Content</label>
                  <textarea placeholder="Enter Content"
                                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content">{{$ContentDetails->content}}</textarea>
                </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </section>

@endsection