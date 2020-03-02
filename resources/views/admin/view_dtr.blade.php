@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Daily Time Record</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daily Time Record</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
            <a href="{{url('/dtrPDF')}}" class="btn btn-primary pull-right"><i class="fa fa-download"></i> DOWNLOAD PDF</a>
              <?php 
                foreach($user as $object){
                  echo "<b>Name:</b> ".$object->name." <br><b>Position:</b> ".$object->user_level." <br><b>Category:</b> ".$sched->category_name." (";
                    if($sched->type == 'Normal'){
                      if($sched->Monday == '1'){
                        echo "Mon,";
                      }
                      if($sched->Tuesday == '1'){
                         echo "Tue,";
                      }
                      if($sched->Wednesday == '1'){
                        echo "Wed,";
                      }
                      if($sched->Thursday == '1'){
                        echo "Thu,";
                      }
                      if($sched->Friday == '1'){
                        echo "Fri,";
                      }
                      if($sched->Saturday == '1'){
                        echo "Sat,";
                      }
                      if($sched->Sunday == '1'){
                        echo "Sun,";
                      }
                    }else{
                      echo $sched->working_days.' days in - '.$sched->day_off.' days out';
                    }
                   echo " )";
                }
              ?>
               
              <br><br>
              <div class="table-responsive mailbox-messages">
              <table  class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Shift</th>
                  <th>AM IN</th>
                  <th>AM OUT</th>
                  <th>PM IN</th>
                  <th>PM OUT</th>
                  <th>Hours Worked</th>
                  <th>Remarks</th>
                  <th>OT</th>
                  <th>Allowance</th>
                </tr>
              </thead>
              <tbody style="font-size:12px">
                <?php
                  //variable declaration
                  $c = 1;
                  $total_allowance = 0;
                  $total_hours = 0;
                  $total_mins = 0;
                  $total_secs = 0;

                ?>
                @foreach($dtr as $object)
                <tr>
                  <td class="mailbox-star"><a href="#"></a>  {{$c}}</td>
                  <td>{{date('F d, Y, l',strtotime($object->date))}}</td>
                  <td>{{$object->sched_start}} - {{$object->sched_end}}</td>
                  <td>{{$object->am_time_in}}</td>
                  <td>{{$object->am_time_out}}</td>
                  <td>{{$object->pm_time_in}}</td>
                  <td>{{$object->pm_time_out}}</td>
                  <td>
                    <!-- checking if all the time fields in database are not null or am are not null or pm are not null-->
                    @if($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in != null && $object->pm_time_out != null || $object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in == null && $object->pm_time_out == null || $object->am_time_in == null && $object->am_time_out == null && $object->pm_time_in != null && $object->pm_time_out != null)
                    <?php

                     

                      if($sched->type == 'Normal'){
                        $am_start  = date_create($object->am_time_in); 
                        $am_end  = date_create($object->am_time_out);
                        $pm_start  = date_create($object->pm_time_in);
                        $pm_time_out = date('h:i:sa',strtotime($object->pm_time_out));
                        $sched_end = date('h:i:sa',strtotime($object->sched_end));
                        $allow = date('h:i:sa',strtotime($object->sched_end.' +30 min'));

                        if($pm_time_out >= $allow){
                          $pm_end  = date_create($object->pm_time_out);                          
                        }elseif($pm_time_out >= $sched_end && $pm_time_out < $allow){
                          $pm_end  = date_create($object->sched_end);                          
                        }

                      }else{
                        $am_start  = date_create($object->am_time_in); 
                        $pm_start  = date_create($object->pm_time_in);
                        $pm_end  = date_create($object->pm_time_out);
                        $am_time_out = date('h:i:sa',strtotime($object->am_time_out));
                        $sched_end = date('h:i:sa',strtotime($object->sched_end));
                        $allow = date('h:i:sa',strtotime($object->sched_end.' +30 min'));

                        if($am_time_out >= $allow){
                          $am_end  = date_create($object->am_time_out);                          
                        }elseif($am_time_out >= $sched_end && $am_time_out < $allow){
                          $am_end  = date_create($object->sched_end);                          
                        }

                      }

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
                      $subtotal_hours = 0;
                      $subtotal_mins = 0;
                      $subtotal_secs = 0;

                      $secs = $am_s + $pm_s;
                      if($secs >= 60){
                        $sround = round($secs/60);
                        $subtotal_secs = $secs%60;
                        $mins = $sround;
                      }else{
                        $subtotal_secs = $secs;
                      }

                      $mins = $mins + $am_m + $pm_m;
                      if($mins >= 60){
                        $mround = round($mins/60);
                        $subtotal_mins = $mins%60;
                        $hours = $mround;
                      }else{
                        $subtotal_mins = $mins;
                      }

                      $subtotal_hours = $hours + $am_h + $pm_h;

                      echo  $subtotal_hours . ' h, ';
                      echo  $subtotal_mins . ' m, ';
                      echo  $subtotal_secs . ' s ';

                      $total_hours = $total_hours + $subtotal_hours;
                      $total_mins = $total_mins + $subtotal_mins;
                      $total_secs = $total_secs + $subtotal_secs; 



                      ?>
                    @else
                    {{0}}
                    @endif
                  </td>
                    <?php
                      echo "<td align='center'";
                      if($object->remarks == 'Absent'){
                        echo "style='background-color:#ff6666;'>";
                        echo $object->remarks;
                      }elseif($object->remarks == 'Present'){
                        echo "style='background-color:#99ff99;'>";
                        echo $object->remarks;
                      }elseif($object->remarks == 'Dayoff'){
                        echo "style='background-color:#99ccff;'>";
                        echo $object->remarks;
                      }elseif($object->remarks == 'Leave'){
                        echo "style='background-color:#ff80ff;'>";
                        echo $object->remarks;
                      }

                      echo "</td>"
                    ?>
                  <td align="center">
                    <?php 
                      if($sched->type == 'Normal'){

                        $pm_time_out = date('h:i:sa',strtotime($object->pm_time_out));
                        $sched_end = date('h:i:sa',strtotime($object->sched_end.' +30 min'));

                        if($object->pm_time_out == Null){ //if not yet timed out
                          echo 0;
                        }elseif($pm_time_out < $sched_end){ //if the timed out is undertime
                          echo 0;
                        }else{ //if the timed out is overtime

                          $shift_end = date_create($object->sched_end);
                          $out = date_create($object->pm_time_out);
                          $overtime   = date_diff($shift_end, $out);

                          $ot = $overtime->h.':'.$overtime->i.':'.$overtime->s;

                          $overtime2 = date('h:i:sa',strtotime($ot));

                          if($overtime2 >= $sched_end){
                            $ot_h = $overtime->h; 
                            $ot_m = $overtime->i;
                            $ot_s = $overtime->s;

                            echo  $ot_h . ' h, ';
                            echo  $ot_m . ' m, ';
                            echo  $ot_s . ' s ';  
                          }else{
                            echo 0;
                          } 
                        }
                      }else{

                        $am_time_out = date('h:i:sa',strtotime($object->am_time_out));
                        $sched_end = date('h:i:sa',strtotime($object->sched_end.' +30 min'));

                        if($object->am_time_out == Null){ //if not yet timed out
                          echo 0;
                        }elseif($am_time_out < $sched_end){ //if the timed out is undertime
                          echo 0;
                        }else{ //if the timed out is overtime
                          $shift_end = date_create($object->sched_end);
                          $out = date_create($object->am_time_out);
                          $overtime   = date_diff($shift_end, $out);

                          $ot = $overtime->h.':'.$overtime->i.':'.$overtime->s;

                          $overtime2 = date('h:i:sa',strtotime($ot));

                          if($overtime2 >= $sched_end){
                            $ot_h = $overtime->h; 
                            $ot_m = $overtime->i;
                            $ot_s = $overtime->s;

                            echo  $ot_h . ' h, ';
                            echo  $ot_m . ' m, ';
                            echo  $ot_s . ' s '; 
                          }else{
                            echo 0;
                          }
                        }
                      }
                     ?>
                  </td>
                  <td align="center">
                    <?php
                    if($sched->type == 'Normal'){
                      // if the user has logged in am to pm 
                      if($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in != null && $object->pm_time_out != null){
                        $total_allowance = $total_allowance + 60;
                        echo 60;
                      }
                      // if the user has logged in am only 
                      elseif($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in == null && $object->pm_time_out == null){
                        $total_allowance = $total_allowance + 20;
                        echo 20;
                      }
                      // if the user has logged in pm only 
                      elseif($object->am_time_in == null && $object->am_time_out == null && $object->pm_time_in != null && $object->pm_time_out != null){ 
                        $total_allowance = $total_allowance + 40;
                        echo 40;
                      }
                    }else{
                      // if the user has logged in am to pm 
                      if($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in != null && $object->pm_time_out != null){
                        $total_allowance = $total_allowance + 80;
                        echo 80;
                      }
                      // if the user has logged in am only 
                      elseif($object->am_time_in != null && $object->am_time_out != null && $object->pm_time_in == null && $object->pm_time_out == null){
                        $total_allowance = $total_allowance + 40;
                        echo 40;
                      }
                      // if the user has logged in pm only 
                      elseif($object->am_time_in == null && $object->am_time_out == null && $object->pm_time_in != null && $object->pm_time_out != null){ 
                        $total_allowance = $total_allowance + 40;
                        echo 40;
                      }
                    }
                    ?>
                  </td>
                </tr>
                <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              </div>

              <div class="table-responsive mailbox-messages">
              <table  class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>Total Hours Worked</th>
                  <th>Total Allowance</th>
                </tr>
              </thead>
              <tbody style="font-size:12px">
                
                <tr>
                  <td>
                    <?php
                      $grandtotal_secs = 0;
                      $grandtotal_mins = 0;
                      $grandtotal_hours = 0;


                      if($total_secs >= 60){
                        $sround = round($total_secs/60);
                        $grandtotal_secs = $total_secs%60;
                        $total_mins = $total_mins + $sround;
                      }else{
                        $grandtotal_secs = $total_secs;
                      }

                      if($total_mins >= 60){
                        $mround = round($mins/60);
                        $grandtotal_mins = $total_mins%60;
                        $total_hours = $total_hours + $mround;
                      }else{
                        $grandtotal_mins = $total_mins;
                      }

                      $grandtotal_hours = $total_hours;

                      echo $grandtotal_hours . " h, " . $grandtotal_mins . " m, " . $grandtotal_secs . " s";
                    ?>
                  </td>
                  <td><?php echo $total_allowance; ?></td>
                </tr>
                
              </tbody>
              </table>
              </div>
            </div>
          </div>
         </div>
        </div>
  </section>
@endsection