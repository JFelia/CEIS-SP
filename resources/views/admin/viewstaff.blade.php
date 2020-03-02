@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>View Staffs</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/staffs">People</a></li>
        <li class="active">View Employees</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
       <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              
              <div class="table-responsive mailbox-messages">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <!-- <th>Box</th> -->
                  <th>No</th>
                  <th>Status</th>
                  <th>Name</th>
                  <!-- <th>Username</th> -->
                  <th>Telephone</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Remarks</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($data as $object)
                <tr>
                  <!-- <td><input type="checkbox"></td> -->
                  <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td> -->
                  <td>{{$c}}</td>
                  @if($object->status == '1')
                  <td><i class="in">IN</i></td>
                  @else
                  <td><i class="out">OUT</i></td>
                  @endif
                  @if($object->id == session()->get('user_id'))
                  <td><a href="{{url('profile')}}" title="view my profile"><b>{{$object->name}}</b></a></td>
                  @else
                  <td><a title="view profile" href="{{url('/admin/staff-profile',[$object->id])}}">{{$object->name}}</a></td>
                  @endif
                  <!-- <td>{{$object->username}}</td> -->
                  <td>{{$object->phone}}</td>
                  <td>{{$object->email}}</td>
                  <td>{{$object->user_level}}</td>
                  <td>
                    @if($object->remarks == 'Employed')
                      <p style="color:green" >Employed</p>
                    @elseif($object->remarks == 'Retired' || $object->remarks == 'Resigned')
                      <p style="color:red" >{{$object->remarks}}</p>
                    @endif
                  </td>                  
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                    @if($object->status == '1' || $object->remarks == 'Resigned' || $object->remarks == 'Retired')
                    <td>
                      <div class="input-group input-group-xs">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" disabled>Action
                          <span class="fa fa-caret-down"></span></button>
                          <ul class="dropdown-menu">
                          @if(session()->get('user_level')=='Admin')
                            <li><a href="{{url('/admin/edit-staff',[$object->id])}}" title="edit" disabled>Edit</a></li>
                          @endif
                            <li><a href="{{url('/admin/delete-staff',[$object->id])}}" title="delete" onclick="return confirm('Are you sure you want to delete this staff?')" disabled>Delete</a></li>
                          </ul>
                        </div>
                      </div>  
                    </td>
                    @else
                    <td>
                      <div class="input-group input-group-sm">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
                          <span class="fa fa-caret-down"></span></button>
                          <ul class="dropdown-menu">
                          @if(session()->get('user_level')=='Admin')
                            <li><a href="{{url('/admin/edit-staff',[$object->id])}}" title="edit">Edit</a></li>
                          @endif
                            <li><a href="{{url('/admin/resign-staff',[$object->id])}}" title="resign" onclick="return confirm('Are you sure you want to resign this staff?')" >Resign</a></li>
                            <li><a href="{{url('/admin/retire-staff',[$object->id])}}" title="retire" onclick="return confirm('Are you sure you want to retire this staff?')" >Retire</a></li>
                            <!-- <li><a href="{{url('/admin/delete-staff',[$object->id])}}" title="delete" onclick="return confirm('Are you sure you want to delete this staff?')" >Delete</a></li> -->
                          </ul>
                        </div>
                      </div>  
                    </td>
                    @endif
                    
                  @endif
                </tr>
                  <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Help</h3>
            </div>
              <div class="box-body">
                <div class="box-body box-profile" style="font-size: 12px">
                    <p>View the <b>Profile</b> by clicking at their <b>Names</b></p>
                    <p>If the staff is currently logged in, the status will be <b>IN</b>, and if not it's <b>OUT</b></p>
                    <p>Can <b>Update Staffs Info</b> at the <b>Action</b> field</p>
                    <!-- <p>Allow <b>Multiple Deletion</b> by clicking the <b>Checkboxes</b> at the left side and click <b>Delete button</b> at the top</p>
                    <p>Click <b>Checkbox</b> at the top, if you wish to <b>Select all</b></p> -->
                    <hr>
                    <p style="color:orange"><b>Take note!!!!!!!!!!!!!!</b></p>
                    <p>You should not <b>Update</b> staffs that is currently logged in.</p>
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
@endsection