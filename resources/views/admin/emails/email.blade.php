@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Client Emails
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Messages</a></li>
        <li class="active">Client Emails</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
        <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              <table id="example4" class="table table-bordered table-striped">
              <thead style="font-size: 12px">
                <th>No.</th>
                <th>Date & Time</th>
                <th>Client</th>
                <th>Recipients</th>
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
                  <td style="text-align:center">{{date('m/d/y h:i:sa',strtotime($object->created_at))}}</td>
                  <td><a href="{{url('/clients/client-profile',[$object->client_id])}}">{{$object->client_name}}</a></td>
                  <td>{{$object->recipients}}</td>
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
                <div class="box-body box-profile" style="font-size: 12px">
                    <p>Can <b>View</b> email by clicking the <b>Eye button</b> on the right side of the message at the <b>Action</b> field</p>
                </div>
              </div>
            </div>
        </div>
        </div>
        </section>

@endsection