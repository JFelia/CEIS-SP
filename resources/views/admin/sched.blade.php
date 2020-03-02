@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Schedule</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Schedule</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
       <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body" ng-app="">
              <form role="form" action="{{URL::to('/admin/editsched')}}" method="post">
              {{csrf_field()}}
              <div class="table-responsive mailbox-messages">
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Schedules</button>
                  <button type="button" data-toggle="modal" data-target="#modal-add-category" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Category</button>
                  <button type="button" data-toggle="modal" data-target="#modal-view-category" class="btn btn-info pull-left" style="margin-left: 12px"><i class="fa fa-gears"></i> Manage Category</button>
                </div>
              <table id="example2" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <!-- <th>Box</th> -->
                  <th>No</th>
                  <th colspan="1">Name</th>
                  <th>User Level</th>
                  <th>In</th>
                  <th>Out</th>
                  <th>Category</th>
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; $counter = 0?>
                @foreach($users as $object)
                <tr>
                  <!-- <td><input type="checkbox"></td> -->
                  <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td> -->
                  <td>{{$c}}</td>
                  @if($object->id == session()->get('user_id'))
                  <td colspan="1" style="border:0;"><a href="{{url('profile')}}" title="view my profile"><b>{{$object->name}}</b></a></td>
                  @else
                  <td colspan="1" style="border:0;"><a title="view profile" href="{{url('/admin/staff-profile',[$object->id])}}">{{$object->name}}</a></td>
                  @endif
                  <input type="hidden" name="<?php echo 'id_'.$counter; ?>" value="{{$object->id}}">
                  <td>{{$object->user_level}}</td>
                  <td>
                    <select style="font-size: 11px;border:0;"  class="form-control" name="<?php echo 'in_'.$counter; ?>" ng-model="<?php echo 'in_'.$counter; ?>">
                        @if($object->sched_start == null || $object->sched_start == 0)
                          <!-- if there is no schedule yet -->
                          <option value="0">Select</option>
                          <?php
                            // this will output an 24 option from 1AM - 12PMP
                            for($a = 1; $a <= 24; $a++){
                              if($a <= 12){
                              //if AM
                          ?>
                              <option value="<?php echo $a; ?>"><?php echo $a; ?>:00 AM</option>
                            <?php }else{ ?>  
                              <!-- if PM -->
                              <option value="<?php echo $a; ?>"><?php echo ($a-12); ?>:00 PM</option>
                            <?php } ?>
                          <?php } ?>
                        @else
                          <!-- if there's already a schedule -->
                          <option value="{{$object->sched_start}}">
                          @if($object->sched_start > '12')
                            <!-- if PM -->
                            {{$object->sched_start - 12}}:00 PM
                          @else
                            <!-- if AM -->
                            {{$object->sched_start}}:00 AM
                          @endif
                          </option>
                          <?php
                            // this will output an 23 option from 1AM - 12PMP
                            for($a = 1; $a <= 24; $a++){
                              if($a <= 12){
                              //if AM
                                if($object->sched_start == $a){
                                  //do not output because it is already output as the first option
                                }else{
                            ?>
                                <option value="<?php echo $a; ?>"><?php echo $a; ?>:00 AM</option>
                              <?php }}else{
                                if($object->sched_start == $a){
                                  //do not output because it is already output as the first option
                                }else{
                              ?>  
                                <!-- if PM -->
                                <option value="<?php echo $a; ?>"><?php echo ($a-12); ?>:00 PM</option>
                              <?php }} ?>
                            <?php } ?>
                        @endif
                    </select>
                  </td>
                  <td>
                    <select style="font-size: 11px;border:0;"  class="form-control" name="<?php echo 'out_'.$counter; ?>" ng-model="<?php echo 'out_'.$counter; ?>">
                        @if($object->sched_end == null || $object->sched_start == 0)
                          <!-- if there is no schedule yet -->
                          <option value="0">Select</option>
                          <?php
                            // this will output an 24 option from 1AM - 12PMP
                            for($a = 1; $a <= 24; $a++){
                              if($a <= 12){
                              //if AM
                          ?>
                              <option value="<?php echo $a; ?>"><?php echo $a; ?>:00 AM</option>
                            <?php }else{ ?>  
                              <!-- if PM -->
                              <option value="<?php echo $a; ?>"><?php echo ($a-12); ?>:00 PM</option>
                            <?php } ?>
                          <?php } ?>
                        @else
                          <!-- if there's already a schedule -->
                          <option value="{{$object->sched_end}}">
                          @if($object->sched_end > '12')
                            <!-- if PM -->
                            {{$object->sched_end - 12}}:00 PM
                          @else
                            <!-- if AM -->
                            {{$object->sched_end}}:00 AM
                          @endif
                          </option>
                          <?php
                            // this will output an 23 option from 1AM - 12PMP
                            for($a = 1; $a <= 24; $a++){
                              if($a <= 12){
                              //if AM
                                if($object->sched_end == $a){
                                  //do not output because it is already output as the first option
                                }else{
                            ?>
                                <option value="<?php echo $a; ?>"><?php echo $a; ?>:00 AM</option>
                              <?php }}else{
                                if($object->sched_end == $a){
                                  //do not output because it is already output as the first option
                                }else{
                              ?>  
                                <!-- if PM -->
                                <option value="<?php echo $a; ?>"><?php echo ($a-12); ?>:00 PM</option>
                              <?php }} ?>
                            <?php } ?>
                        @endif
                    </select>
                  </td>
                  <td>
                    <select style="font-size: 11px;border:0;"  class="form-control" name="<?php echo 'cat_'.$counter; ?>" ng-model="<?php echo 'cat_'.$counter; ?>">
                      
                        <option value="0">Select Category: </option>
                        @foreach($categories as $obj)
                          @if($obj->id == $object->sched_cat && $obj->type == 'Normal')
                             <option value="{{$obj->id}}" selected>
                            {{$obj->category_name }}
                            (
                            @if($obj->type == 'Normal')
                              @if($obj->Monday == '1')
                                Mon,
                              @endif
                              @if($obj->Tuesday == '1')
                                Tue,
                              @endif
                              @if($obj->Wednesday == '1')
                                Wed,
                              @endif
                              @if($obj->Thursday == '1')
                                Thu,
                              @endif
                              @if($obj->Friday == '1')
                                Fri,
                              @endif
                              @if($obj->Saturday == '1')
                                Sat,
                              @endif
                              @if($obj->Sunday == '1')
                                Sun,
                              @endif
                            @else
                              {{$obj->working_days}} - {{$obj->day_off}}
                            @endif
                            )
                            </option>
                            
                          @elseif($obj->id == $object->sched_cat && $obj->type == 'Special')
                            <option value="{{$obj->id}}" selected>
                            {{$obj->category_name }} (
                            {{$obj->working_days}} days In - {{$obj->day_off}} days Out )
                            </option>
                            
                          @else
                            <option value="{{$obj->id}}">
                            {{$obj->category_name }}
                            (
                            @if($obj->type == 'Normal')
                              @if($obj->Monday == '1')
                                Mon,
                              @endif
                              @if($obj->Tuesday == '1')
                                Tue,
                              @endif
                              @if($obj->Wednesday == '1')
                                Wed,
                              @endif
                              @if($obj->Thursday == '1')
                                Thu,
                              @endif
                              @if($obj->Friday == '1')
                                Fri,
                              @endif
                              @if($obj->Saturday == '1')
                                Sat,
                              @endif
                              @if($obj->Sunday == '1')
                                Sun,
                              @endif
                            @else
                              {{$obj->working_days}} days In - {{$obj->day_off}} days Out
                            @endif
                            )
                            </option>
                          @endif
                          
                        @endforeach
                      
                    </select> 
                    
                  </td>

                  </tr>

                  <?php $c++; $counter++; ?>

                @endforeach
              </tbody>
              </table>
                  <input type="hidden" name="count" value="<?php echo $c; ?>">
              </div>
                
            </form>
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
                    <p>1) View the <b>Profile</b> by clicking at their <b>Names</b></p>
                    <p>2) Add/Create <b>Schedule Category</b></p>
                    <p>3) Manage the Category</p>
                    <p>4) Select starting time of shift</p>
                    <p>5) Select closing time of shift</p>
                    <p>6) Select category of schedule <br>
                    <p>7) Click Save Schedules</p>
                    <p>8) Search for anyone in the search area</p>
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
@endsection





<div class="modal modal-info fade" id="modal-add-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Category</h4>
              </div>
              <form action="/add_category" method="POST">
              <div class="modal-body" >
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                      </div>
                      <div class="form-group">
                          <label>Type</label>
                          <select class="form-control"  name="type" style="width: 100%;" required>
                            <option value="0">Select Type:</option>
                            <option value="Normal">Normal Schedule</option>
                            <option value="Special">Special Schedule</option>
                          </select>
                      </div>
                      <br><br>
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                   
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



        <div class="modal modal-info fade" id="modal-view-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Manage Categories</h4>
              </div>
              
              <div class="modal-body" >
                <div class="row">
                  
                  <div class="col-md-12">
                      <div class="table-responsive mailbox-messages">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead style="font-size:12px">
                          <tr>
                            <!-- <th>Box</th> -->
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="font-size:11px">
                          <?php $c = 1; ?>
                          @foreach($categories as $object)
                          <tr>
                            <td>{{$c}}</td>
                            <td>{{$object->category_name}}</td>
                            <td>{{$object->type}}</td>
                            <td>
                            @if($object->status == '0')
                              @if($object->type == 'Normal')
                                <a class="btn btn-primary btn-xs" href="{{url('/update_normal',[$object->id])}}" title="add dates"><i class="fa fa-plus"></i> Add Dates</a>
                              @else
                                <a class="btn btn-primary btn-xs" href="{{url('/update_special',[$object->id])}}" title="add interval"><i class="fa fa-plus"></i> Add Interval</a>
                              @endif
                            @else
                              <button class="btn btn-success btn-xs" title="Completed"><i class="fa fa-check"></i> Completed</button>
                            @endif
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
                    
              </div>
              
            </div>
          </div>
        </div>