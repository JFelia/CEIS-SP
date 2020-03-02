@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Client Emails
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Messages</a></li>
        <li class="active">Transaction</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
        <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              <table id="example4" class="table table-bordered table-striped">
              <thead>
                <th>No.</th>
                <th>Date & Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>View</th>
              </thead>
              <tbody>
                <?php $c = 1; ?>
                @foreach($outbox as $object)
                @if($object->status == 'unread' || $object->replystats > 0)
                <tr style="font-size: 11px; background-color:#bfbfbf">
                @else
                <tr style="font-size: 11px;">
                @endif
                  <td>{{$c}}</td>
                  <td style="text-align:center">{{date('F d, Y h:i:sa',strtotime($object->created_at))}}</td>
                  <td>{{$object->message}}</td>
                  @if($object->status == 'unread')
                  <td>{{'Please Read'}}</td>
                  @else
                  <td>{{$object->status}}</td>
                  @endif
                  <td style="text-align:center">
                  <a href="/replies/{{$object->id}}" title="view"><span class="fa fa-eye"></span></a>
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
                <div class="box-body box-profile">
                    <p>~ Can <b>Forward</b> message by clicking the <b>Share button</b> on the right side of the message at the <b>Action</b> field</p>
                    <hr>
                    <p><b>Take note!</b></p>
                    <p>~ <b>Client</b> is the one who request to send a message.</p>
                </div>
              </div>
            </div>
        </div>
        </div>
        </section>

@endsection