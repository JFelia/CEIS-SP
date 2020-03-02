@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Holiday</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Holiday</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body">
              <h4>Add Holiday</h4>
              <hr>
                  <form method="POST" action="{{url('/holiday')}}">
                      {{csrf_field()}}
                      <label>Holiday Description</label>
                      <input type="text" name="description" placeholder="Enter holiday description" class="form-control" autocomplete="off">
                      {!! $errors->first('description','<p class="alert alert-danger">:message</p>') !!}
                      <label>Date</label>
                      <input type="date" name="date" placeholder="MM-DD" class="form-control" autocomplete="off">
                      {!! $errors->first('date','<p class="alert alert-danger">:message</p>') !!}
                    <br>
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
              <h4>Holidays</h4>
              <hr>
                  <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <!-- <th>Box</th> -->
                  <th>No</th>
                  
                  <th>Description</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Date</th>
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; 

                  foreach($holiday as $object){
                ?>
                
                <tr>
                  <td>{{$c}}</td>
                  
                  <td>{{$object->description}}</td>
                  <td>
                  <!-- <?php //echo date('F d',strtotime($object->date)); ?> -->
                  {{date('F d',strtotime($object->date))}}
                  </td>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{url('/admin/edit-holiday',[$object->id])}}" class="btn btn-info btn-xs" title="edit"><span class="fa fa-pencil"></span></a>
                      <a href="{{url('/admin/delete-holiday',[$object->id])}}" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Are you sure you want to delete this staff?')" ><span class="fa fa-trash"></span></a>
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
  </section>
@endsection