@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Attendance
        @if(Auth::user()->user_level != 'Client')
          @if(Auth::user()->sched_start == null || Auth::user()->sched_start == 0)
            <button type="button" data-toggle="modal" data-target="#modal-request-leave" class="btn btn-primary btn-sm" title="Waiting for HR to assign you your schedule" disabled="">Request Leave</button>
          @else
            <button type="button" data-toggle="modal" data-target="#modal-request-leave" class="btn btn-primary btn-sm" title="request leave">Request Leave</button>
          @endif
        @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div class="box box-primary">
        <div class="box-body">
            
              <div class="table-responsive mailbox-messages">
            @if(Auth::user()->sched_start == null || Auth::user()->sched_start == 0)
              <a class="btn btn-warning btn-flat"> YOUR NOT ALLOWED TO ATTENDANCE AT THE MOMENT</a>
            @elseif($checkifleave > 0)
              <a class="btn btn-warning btn-flat"> YOU ARE ON LEAVE</a>
            @elseif(session()->get('priviledge') == 'NoWork')
              <a class="btn btn-warning btn-flat"> Today is <?php echo date('l',strtotime(NOW())); ?>, you don't have work today!</a>
            @elseif(session()->get('priviledge')=='DayOff')
              @if(Auth::user()->Four_D == '1')
                @if(date('H',strtotime(NOW())) < 12)
                  <?php $a = 1; //declaring variable with value of first one in descending order?>
                  @foreach($td as $object)

                    <!-- am in validation -->
                    <?php if($a == 1){ //condition for checking only the latest dtr?>
                    @if($object->am_time_in != null)
                      <a class="btn btn-success">AM In</a>
                    @else
                      <a title="attendance" href="{{url('/time',[1])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">AM In</a>
                    @endif
                    <!-- am out validation -->
                    @if($object->am_time_out != null)
                      <a class="btn btn-success">AM Out</a>
                    @else
                      <a title="attendance" href="{{url('/time',[2])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">AM Out</a>
                    @endif
                    <?php } $a++; ?>
                  @endforeach
                @else
                  <a class="btn btn-warning btn-flat"> Today is your Day-off</a>
                @endif
              @else
                <a class="btn btn-warning btn-flat"> Today is your Day Off!</a>
              @endif
            @elseif(Auth::user()->Four_D == '1' && Auth::user()->Four_D_status == 'In')
              @if(date('H',strtotime(NOW())) > 12)
                  <?php $a = 1; //declaring variable with value of first one in descending order?>
                  @foreach($td as $object)

                    <!-- am in validation -->
                    <?php if($a == 1){ //condition for checking only the latest dtr?>
                    @if($object->pm_time_in != null)
                      <a class="btn btn-success">PM In</a>
                    @else
                      <a title="attendance" href="{{url('/time',[3])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">PM In</a>
                    @endif
                    <!-- am out validation -->
                    @if($object->pm_time_out != null)
                      <a class="btn btn-success">PM Out</a>
                    @else
                      <a title="attendance" href="{{url('/time',[4])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">PM Out</a>
                    @endif
                    <?php } $a++; ?>
                  @endforeach
                @else
                  <a class="btn btn-warning btn-flat"> Today's morning is your Day-off, comeback this afternoon for Attendance</a>
                @endif
            @else
                @if($check == 0)
                  @if(date('H',strtotime(NOW())) < 12)
                    <a title="attendance" href="{{url('/time',[1])}}" class="btn btn-info btn-flat" onclick="return confirm('Are you sure you want to attendance now?')"> AM In</a>
                    <a title="attendance" href="{{url('/time',[2])}}" class="btn btn-info btn-flat" onclick="return confirm('Are you sure you want to attendance now?')"> AM Out</a>
                    <a href="{{url('/time',[3])}}" class="btn btn-info btn-flat disabled"> PM In</a>
                    <a href="{{url('/time',[4])}}" class="btn btn-info btn-flat disabled"> PM Out</a>
                  @else
                    <a href="{{url('/time',[1])}}" class="btn btn-info btn-flat disabled"> AM In</a>
                    <a href="{{url('/time',[2])}}" class="btn btn-info btn-flat disabled"> AM Out</a>
                    <a title="attendance" href="{{url('/time',[3])}}" class="btn btn-info btn-flat" onclick="return confirm('Are you sure you want to attendance now?')"> PM In</a>
                    <a title="attendance" href="{{url('/time',[4])}}" class="btn btn-info btn-flat" onclick="return confirm('Are you sure you want to attendance now?')"> PM Out</a>
                  @endif
                @else
                  @if(date('H',strtotime(NOW())) < 12)
                    <?php $a = 1; //declaring variable with value of first one in descending order?>
                    @foreach($td as $object)

                      <!-- am in validation -->
                      <?php if($a == 1){ //condition for checking only the latest dtr?>
                      @if($object->am_time_in != null)
                        <a class="btn btn-success">AM In</a>
                      @else
                        <a title="attendance" href="{{url('/time',[1])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">AM In</a>
                      @endif
                      <!-- am out validation -->
                      @if($object->am_time_out != null)
                        <a class="btn btn-success">AM Out</a>
                      @else
                        <a title="attendance" href="{{url('/time',[2])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">AM Out</a>
                      @endif

                        <!-- pm in validation -->
                      @if($object->pm_time_in != null)
                        <a class="btn btn-success">PM In</a>
                      @else
                        <a class="btn btn-info disabled">PM In</a>
                      @endif
                      <!-- pm out validation -->
                      @if($object->pm_time_out != null)
                        <a class="btn btn-success">PM Out</a>
                      @else
                        <a class="btn btn-info disabled">PM Out</a>
                      @endif
                      <?php } $a++; ?>
                    @endforeach
                  @else
                    <?php $a = 1; //declaring variable with value of first one in descending order?>
                    @foreach($td as $object)

                      <!-- am in validation -->
                      <?php if($a == 1){ //condition for checking only the latest dtr?>
                      @if($object->am_time_in != null)
                        <a class="btn btn-success">AM In</a>
                      @else
                        <a class="btn btn-info disabled">AM In</a>
                      @endif
                      <!-- am out validation -->
                      @if($object->am_time_out != null)
                        <a class="btn btn-success">AM Out</a>
                      @else
                        <a class="btn btn-info disabled">AM Out</a>
                      @endif

                      <!-- pm in validation -->
                      @if($object->pm_time_in != null)
                        <a class="btn btn-success">PM In</a>
                      @else
                        <a title="attendance" href="{{url('/time',[3])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">PM In</a>
                      @endif
                      <!-- pm out validation -->
                      @if($object->pm_time_out != null)
                        <a class="btn btn-success">PM Out</a>
                      @else
                        <a title="attendance" href="{{url('/time',[4])}}" class="btn btn-info" onclick="return confirm('Are you sure you want to attendance now?')">PM Out</a>
                      @endif
                      <?php } $a++; //incrementation to stop?>
                    @endforeach
                  @endif
                @endif
            @endif
              <br><br><br>  
              <table id="example2" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>AM In</th>
                  <th>AM Out</th>
                  <th>PM In</th>
                  <th>PM Out</th>
                  <th>Hours Worked</th>
                  <th>Date</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody style="font-size:12px">
                <?php $c = 1; ?>
                @foreach($td as $object)
                <tr>
                  <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td>
                  <td>{{$object->am_time_in}}</td>
                  <td>{{$object->am_time_out}}</td>
                  <td>{{$object->pm_time_in}}</td>
                  <td>{{$object->pm_time_out}}</td>
                  <td>
                    <!-- checking if all the time fields in database are not null or am are not null or pm are not null-->
                    @if($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in != null && $object->pm_time_out != null || $object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in == null && $object->pm_time_out == null || $object->am_time_in == null && $object->am_time_out == null && $object->pm_time_in != null && $object->pm_time_out != null)
                    <?php
                      //http://webdevzoom.com/calculate-date-time-difference-php/
                      $am_start  = date_create($object->am_time_in);
                      $am_end  = date_create($object->am_time_out);
                      $pm_start  = date_create($object->pm_time_in);
                      $pm_end  = date_create($object->pm_time_out);

                      $am_diff   = date_diff( $am_start, $am_end );
                      $pm_diff   = date_diff( $pm_start, $pm_end );

                      $am_h = $am_diff->h;
                      $am_m = $am_diff->i;
                      $am_s = $am_diff->s;
                      $pm_h = $pm_diff->h;
                      $pm_m = $pm_diff->i;
                      $pm_s = $pm_diff->s;

                      $hours = 0;
                      $mins = 0;
                      $secs = 0;
                      $total_hours = 0;
                      $total_mins = 0;
                      $total_secs = 0;

                      $secs = $am_s + $pm_s;
                      if($secs >= 60){
                        $sround = round($secs/60);
                        $total_secs = $secs%60;
                        $mins = $sround;
                      }else{
                        $total_secs = $secs;
                      }

                      $mins = $mins + $am_m + $pm_m;
                      if($mins >= 60){
                        $mround = round($mins/60);
                        $total_mins = $mins%60;
                        $hours = $mround;
                      }else{
                        $total_mins = $mins;
                      }

                      $total_hours = $hours + $am_h + $pm_h;

                      echo  $total_hours . ' h, ';
                      echo  $total_mins . ' m, ';
                      echo  $total_secs . ' s ';
                      ?>
                    @else
                    {{0}}
                    @endif
                  </td>
                  <td>{{date('F d, Y',strtotime($object->date))}}</td>
                  <td>{{$object->remarks}}</td>
                </tr>
                <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              </div>
            </div>
          </div>
         </div>
        </div>
  </section>
@endsection



<div class="modal modal-info fade" id="modal-request-leave">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Request Leave</h4>
              </div>
              <form action="/request_leave" method="POST">
              <div class="modal-body" >
                <div class="row">
                  <div class="col-md-5">
                   
                      <label>Type of Leave</label>
                      <select class="form-control" name="type" required>
                            <!-- <option>Choose</option> -->
                            @foreach($leaves as $obj)
                            <option value="{{$obj->name}}">{{$obj->name}}</option>
                            @endforeach
                          </select>
                      <label>Target Start Date</label>
                      <input type="date" name="start_date" class="form-control" placeholder="Target Date" required>
                      <label>Target End Date</label>
                      <input type="date" name="end_date" class="form-control" placeholder="Target Date" required>
                      <br><br>
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                   
                  </div>
                  <div class="col-md-7">
                      <div class="table-responsive mailbox-messages">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead style="font-size:12px">
                          <tr>
                            <!-- <th>Box</th> -->
                            <th>No</th>
                            <th>Request</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Remarks</th>
                          </tr>
                        </thead>
                        <tbody style="font-size:11px">
                          <?php $c = 1; ?>
                          @foreach($leave_requests as $object)
                          <tr>
                            <!-- <td><input type="checkbox"></td> -->
                            <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td> -->
                            <td>{{$c}}</td>
                            <td>{{$object->request}}</td>
                            <td>{{$object->start_date}}</td>
                            <td>{{$object->end_date}}</td>
                            <td>
                            <?php 
                                if($object->remarks == 0){
                                  echo 'Waiting';
                                }elseif($object->remarks == 1){
                                  echo 'Approved';
                                }else{
                                  echo 'Disapproved';
                                }
                             ?>
                            </td>
                          </tr>
                            <?php $c++; ?>
                          @endforeach
                        </tbody>
                        </table>
                        </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-cloud-upload"></i> Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>