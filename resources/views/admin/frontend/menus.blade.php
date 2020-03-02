@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
      Menus
      <button type="button" data-toggle="modal" data-target="#modal-menu-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/menus">Frontend</a></li>
        <li class="active">Menus</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body">
              <h4>Add Menus</h4>
              <hr>
                  <form method="POST" action="{{url('/create_menu')}}">
                      {{csrf_field()}}
                      <div class="form-group{{$errors->has('name')?' has-error' : ''}}">
                        <label>Name</label>
                        <input type="text" name="name" id="myemoji" placeholder="Enter Menu Name" class="form-control" autocomplete="off">
                        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                      </div>
                      <div class="form-group{{$errors->has('type')?' has-error' : ''}}">
                        <label>Type</label>
                        <select class="form-control" name="type">
                          <option value="0">Choose</option>
                          <option value="Parent">Parent</option>
                          <option value="Child">Child</option>
                        </select>
                        {!! $errors->first('type','<span class="help-block">:message</span>') !!}
                      </div>
                      
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
              <form method="POST" action="{{url('/save_menu')}}">
              {{csrf_field()}}
              <h4>Menus
              <button type="submit" class="btn btn-warning btn-flat pull-right"> Save Changes</button>
              </h4>
              <hr>
                  <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Parent</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; $counter = 1;

                  foreach($menus as $object){
                ?>
                <tr>
                  <td>{{$c}}</td>
                  <td>{{$object->name}}</td>
                  <td>{{$object->type}}</td>
                  <td>
                    @if($object->type == 'Child')
                      <?php $counter++; ?>
                      <input type="hidden" name="<?php echo 'id_'.$counter; ?>" value="{{$object->id}}">
                      <select style="font-size: 11px;border:0;"  class="form-control" name="<?php echo 'parent_'.$counter; ?>">
                        <option value="0">Select</option>
                        @foreach($parents as $object2)
                          @if($object->parent == $object2->id)
                            <option value="{{$object2->id}}" selected>{{$object2->name}}</option>
                          @else
                            <option value="{{$object2->id}}">{{$object2->name}}</option>
                          @endif
                            
                        @endforeach
                      </select>

                    @else
                      None
                    @endif
                  </td>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{url('/admin/edit-menu',[$object->id])}}" class="btn btn-info btn-xs" title="edit"><span class="fa fa-pencil"></span></a>
                      <a href="{{url('/admin/delete-menu',[$object->id])}}" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Are you sure you want to delete this menu?')" ><span class="fa fa-trash"></span></a>
                  </td>
                  @endif
                </tr>
                  <?php $c++; }?>
                
              </tbody>
              </table>
              </div>
               <input type="hidden" name="count" value="<?php echo $counter; ?>">
              </form>
            </div>
          </div>  
    </div>
    </div>
  </section>
@endsection