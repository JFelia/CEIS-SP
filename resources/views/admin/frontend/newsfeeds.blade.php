
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>NewsFeeds</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/newsfeeds">Frontend</a></li>
        <li class="active">NewsFeeds</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">NewsFeeds Information</h3>
            </div>
            @foreach($page as $obj)
            <form role="form" enctype="multipart/form-data" action="{{url('/newsfeeds',[$obj->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    
                    <div class="form-group">
                      <label>NewsFeeds</label>
                      <textarea id='editor1' placeholder="Enter NewsFeeds" name="newsfeeds">{{$obj->newsfeeds}}</textarea>
                    </div>
                    

                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            @endforeach
          </div>
          </section>

@endsection