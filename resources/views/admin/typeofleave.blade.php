@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
      Type of Leave
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Type of Leave</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body">
              <h4>Add Type of Leave</h4>
              <hr>
                  <form method="POST" action="{{url('/create_type_of_leave')}}">
                      {{csrf_field()}}
                      <div class="form-group{{$errors->has('name')?' has-error' : ''}}">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter Type of Leave Name" class="form-control" autocomplete="off">
                        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                      </div>
                    <div class="pull-right">
                      
                      <button type="submit" class="btn btn-warning btn-flat"> Create</button>
                  </div>
                  </form>
              
            </div>
          </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
        <div class="box-body">
              <h4>Type of Leaves</h4>
              <hr>
                  <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Name</th> 
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; 

                  foreach($leaves as $object){
                ?>
                <tr>
                  <td>{{$c}}</td>
                  <td>{{$object->name}}</td>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{url('/admin/edit-leave',[$object->id])}}" class="btn btn-info btn-xs" title="edit"><span class="fa fa-pencil"></span></a>
                  </td>
                  @endif
                </tr>
                  <?php $c++; }?>
                
              </tbody>
              </table>
              </div>
              
            </div>
          </div>  
    </div>
    </div>
    <br><br><br><br><br><br>
  </section>
@endsection