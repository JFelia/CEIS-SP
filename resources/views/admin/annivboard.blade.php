@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Anniversary Board</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Anniversary Board</li>
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
                  <th>Name</th>
                  <th>Role</th>
                  <th>Anniversary</th>
                  <th>#Years</th>
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($users as $object)
                <tr>
                  <td>{{$c}}</td>
                  @if($object->id == session()->get('user_id'))
                  <td><a href="{{url('profile')}}" title="view my profile"><b>{{$object->name}}</b></a></td>
                  @else
                  <td><a title="view profile" href="{{url('/admin/staff-profile',[$object->id])}}">{{$object->name}}</a></td>
                  @endif
                  <td>{{$object->user_level}}</td>
                  <td>
                  <?php 
                      $annivdate = $object->anniv_year."-".$object->anniversary;
                   ?>
                  {{date('F d, Y', strtotime($annivdate))}}</td>
                  <td>
                    <?php
                      $years = date('Y',strtotime(NOW())) - $object->anniv_year;
                      if(date('m d', strtotime($annivdate)) < date('m d', strtotime(NOW()))){
                        echo $years;
                      }else{
                        if($years == 0){
                          echo 0;
                        }else{
                          $years = $years - 1;
                          echo $years;  
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
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
@endsection