<!DOCTYPE html>

<html>
<head>
	<title>Hi</title>
</head>
<body>
  <?php 
    $c = 0;
    foreach($dtr as $object){
      if($c == 0){
        echo "<center><p><b>GREYMOUSE INVESTMENTS, LTD, INC.<br>DTR as of " . date('F, Y',strtotime($object->month_year)) . "</b></p></center>";
        echo "<b>Name:</b> ".$object->name;  
      }
    }
  ?>
  <br><br>
	<table class="table table-bordered table-striped" border='1' width="100%" cellpadding="0" cellspacing="0">
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
                  <td>{{date('F d, Y',strtotime($object->date))}}</td>
                  <td>{{$object->sched}}</td>
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
                  <td align="center">{{$object->remarks}}</td>
                  <td align="center">
                    <?php
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
                    ?>
                  </td>
                </tr>
                <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              <br>
              <table  class="table table-bordered table-striped" border="1" width="100%" cellspacing="0" cellpadding="0">
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

	
</body>
</html>