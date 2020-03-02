
@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>Page</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/page">Frontend</a></li>
        <li class="active">Page</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Page Information</h3>
            </div>
            @foreach($page as $obj)
            <form role="form" enctype="multipart/form-data" action="{{url('/page',[$obj->id])}}" method="post">
            {{csrf_field()}}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        Logo
                        <?php 
                          if($obj->logo != null){
                            echo "(has logo already)";
                          }
                        ?>
                      </label>
                      <input type="file" name="logo" value="{{$obj->logo}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Header</label>
                      <textarea id='editor1' placeholder="Enter Header" name="header">{{$obj->header}}</textarea>
                    </div>
                    <div class="form-group">
                    <label>Footer</label>
                    <div class="input-group">
                      <span class="input-group-addon">&copy;</span>
                      <input type="text" name="footer" value="{{$obj->footer}}" class="form-control" placeholder="Enter Footer">
                    </div>
                    </div>
                    <div class="form-group">
                      <label>
                        Background 1
                        <?php 
                          if($obj->background1 != null){
                            echo "(has background 1 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title1" value="{{$obj->title1}}" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg1" value="{{$obj->background1}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 1</label>
                      <input type="text" name="subject1" value="{{$obj->subject1}}" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor2' placeholder="Enter Content 1"
                                       name="content1">{{$obj->content1}}</textarea>
                    </div>  
                    
                  </div>

                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label>
                        Background 2
                        <?php 
                          if($obj->background2 != null){
                            echo "(has background 2 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title2" value="{{$obj->title2}}" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg2" value="{{$obj->background2}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 2</label>
                      <input type="text" name="subject2" value="{{$obj->subject2}}" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor3' placeholder="Enter Content 2" name="content2">{{$obj->content2}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>
                        Background 3
                        <?php 
                          if($obj->background3 != null){
                            echo "(has background 3 already)";
                          }
                        ?>
                      </label>
                      <input type="text" name="title3" value="{{$obj->title3}}" class="form-control" placeholder="Enter Background Title">
                      <input type="file" name="bg3" value="{{$obj->background3}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Content 3</label>
                      <input type="text" name="subject3" value="{{$obj->subject3}}" class="form-control" placeholder="Enter Content Title">
                      <textarea id='editor4' placeholder="Enter Content 3" name="content3">{{$obj->content3}}</textarea>
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