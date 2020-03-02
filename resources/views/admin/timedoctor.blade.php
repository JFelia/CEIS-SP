@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Daily Time Record</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daily Time Record</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
            
              <div class="table-responsive mailbox-messages">
              <table id="example2" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>User Level</th>
                  <th>Month & Year</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody style="font-size:12px">
                <?php $c = 1; ?>
                @foreach($td as $object)
                  <tr>
                    <td class="mailbox-star"><a href="#"></a>  {{$c}}</td>
                    <td>{{$object->name}}</td>
                    <td>{{$object->user_level}}</td>
                    <td>{{date('F, Y',strtotime($object->date))}}</td>
                    <td>
                      <?php 
                        if(date('d',strtotime($object->date)) <= 15){
                          echo '(15\'s)';
                        }else{
                          echo '(30\'s)';
                        }
                       ?>

                    </td>
                    <!-- <td></td> -->
                    <td>
                      <a href="{{url('/view_dtr',[$object->id])}}" class="btn btn-info btn-xs" title="view dtr"><span class="fa fa-eye"></span></a>
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
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
  </section>
@endsection