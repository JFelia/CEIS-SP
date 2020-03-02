@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Leave Requests</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave Requests</li>
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
                  
                  <th>No</th>
                  <th>Name</th>
                  <th>Request</th>
                  <th>Start</th>
                  <th>End</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($LeaveDetails as $object)
                <tr>
                  <td>{{$c}}</td>
                  @if($object->id == session()->get('user_id'))
                  <td><a href="{{url('profile')}}" title="view my profile"><b>{{$object->name}}</b></a></td>
                  @else
                  <td><a title="view profile" href="{{url('/admin/staff-profile',[$object->id])}}">{{$object->name}}</a></td>
                  @endif
                  <td>{{$object->request}}</td>
                  <td>{{date('F d, Y',strtotime($object->start_date))}}</td>
                  <td>{{date('F d, Y',strtotime($object->end_date))}}</td>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{url('/requests',[$object->id])}}" class="btn btn-info btn-xs" title="approve"><span class="fa fa-thumbs-up"></span></a>
                      <a href="{{url('/requests_disapproved',[$object->id])}}" class="btn btn-danger btn-xs" title="disapprove" onclick="return confirm('Are you sure you want to disapprove this request?')" ><span class="fa fa-thumbs-down"></span></a>
                  </td>
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
                    <p>Can <b>Approved or Disapproved</b> any leave requests</p>
                    
                </div>
              </div>
            </div>
        </div>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br>
  </section>
@endsection