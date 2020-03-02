@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Sent Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/messages">Messages</a></li>
        <li class="active">Sent Items</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
        <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              <table id="example3" class="table table-bordered table-striped">
              <thead style="font-size: 12px">
                <th>No.</th>
                <th>Date & Time</th>
                <th>Client</th>
                <th>Sender (To:) - Message</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php $c = 1; ?>
                @if(Auth::user()->user_level != 'Client')
                  @foreach($outbox as $object)
                  <tr style="font-size: 11px">
                    <td>{{$c}}</td>
                    <td style="text-align:center">{{date('F d, Y h:i:sa',strtotime($object->created_at))}}</td>
                    <td><a href="{{url('/clients/client-profile',[$object->client_id])}}">{{$object->client_name}}</a></td>
                    <td><p><b style="color:#666666">{{$object->sender}}</b> <b style="color:#4dc3ff">(+{{$object->contact_no}})</b> - {{$object->message}}</p></td>
                    <td style="text-align:center">
                    <a href="{{url('/messages/forward',[$object->message_id])}}" title="forward"><span class="fa fa-share-alt"></span></a>
                    </td>
                  </tr>
                  <?php $c++; ?>
                  @endforeach
                @else
                  @foreach($outbox as $object)
                    @if($object->client_id == Auth::user()->id)
                    <tr style="font-size: 11px">
                      <td>{{$c}}</td>
                      <td style="text-align:center">{{date('F d, Y h:i:sa',strtotime($object->created_at))}}</td>
                      <td><a href="{{url('/clients/client-profile',[$object->client_id])}}">{{$object->client_name}}</a></td>
                      <td><p><b style="color:#666666">{{$object->sender}}</b> <b style="color:#4dc3ff">(+{{$object->contact_no}})</b> - {{$object->message}}</p></td>
                      <td style="text-align:center">
                      <a href="{{url('/messages/forward',[$object->message_id])}}" title="forward"><span class="fa fa-share-alt"></span></a>
                      </td>
                    </tr>
                    <?php $c++; ?>
                    @endif
                  @endforeach
                @endif
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
                    <p>Can <b>Forward</b> message by clicking the <b>Share button</b> on the right side of the message at the <b>Action</b> field</p>
                    <hr>
                    <p><b>Take note!</b></p>
                    <p><b>Client</b> is the one who request to send a message.</p>
                </div>
              </div>
            </div>
        </div>
          </div>
  </section>

@endsection