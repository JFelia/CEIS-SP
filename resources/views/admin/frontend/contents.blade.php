@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
      Content
      <button type="button" data-toggle="modal" data-target="#modal-contents-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/contents">Frontend</a></li>
        <li class="active">Content</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
        <div class="box-body">
              <h4>Add Content</h4>
              <hr>
                  <form method="POST" action="{{url('/create_content')}}">
                      {{csrf_field()}}
                      <label>Title</label>
                      <input type="text" name="title" placeholder="Enter Content Title" class="form-control" autocomplete="off" required>
                      <label>Content</label>
                      <textarea placeholder="Enter Content"
                                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content" required></textarea>
                    <br>
                    <div class="pull-right">
                      
                      <button type="submit" class="btn btn-warning btn-flat"> Create</button>
                  </div>
                  </form>
              
            </div>
          </div>  
      </div>
      <div class="col-md-8">
        <div class="box box-primary">
        <div class="box-body">
          <form method="POST" action="{{url('/save_content')}}">
              {{csrf_field()}}
              <h4>Contents
              <button type="submit" class="btn btn-warning btn-flat pull-right"> Save Changes</button>
              </h4>
              <hr>
                  <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Target</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; $counter=1;

                  foreach($contents as $object){
                ?>
                <tr>
                  <td>{{$c}}</td>
                  <td>{{$object->title}}</td>
                  <td>{{$object->content}}</td>
                  <td>
                    <input type="hidden" name="<?php echo 'id_'.$counter; ?>" value="{{$object->id}}">
                      <select style="font-size: 11px;border:0;"  class="form-control" name="<?php echo 'target_'.$counter; ?>">
                        <option value="0">Select</option>
                        @foreach($menus as $object2)
                          @if($object->target == $object2->id)
                            <option value="{{$object2->id}}" selected>{{$object2->name}}</option>
                          @else
                            <option value="{{$object2->id}}">{{$object2->name}}</option>
                          @endif
                            
                        @endforeach
                      </select>
                  </td>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{url('/admin/edit-content',[$object->id])}}" class="btn btn-info btn-xs" title="edit"><span class="fa fa-pencil"></span></a>
                      <a href="{{url('/admin/delete-content',[$object->id])}}" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Are you sure you want to delete this content?')" ><span class="fa fa-trash"></span></a>
                  </td>
                  @endif
                </tr>
                  
                  <?php $counter++; $c++; ?>
                  <?php }?> 
                
              </tbody>
              </table>
              </div>
              
            </div>
            <input type="hidden" name="count" value="<?php echo $counter; ?>">
            </form>
          </div>  
      </div>
    </div>
  </section>
@endsection