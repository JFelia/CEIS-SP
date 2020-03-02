@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>View Logs</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/logs">Reports</a></li>
        <li class="active">Logs</li>
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
                  <th>Logs</th>
                  <th>Date & Time</th>
                </tr>
              </thead>
              <tbody style="font-size:12px">
                <?php $c = 1; ?>
                @foreach($logs as $object)
                <tr>
                  <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td>
                  <td>{{$object->log}}</td>
                  <td>{{date('F d, Y - h:i:sa',strtotime($object->created_at))}}</td>
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