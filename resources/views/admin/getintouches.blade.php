@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Get In Touch</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Get In Touch</li>
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
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($getintouches as $object)
                <tr>
                  <td>{{$c}}</td>
                  <td>{{$object->fullname}}</td>
                  <td>{{$object->email}}</td>
                  <td>{{$object->message}}</td>
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
                    <p>View the messages from guest users</p>
                </div>
              </div>
            </div>
        </div>
      </div>
  </section>
@endsection