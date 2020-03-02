@extends('layouts.adminLayout.admin_design')
@section('content')
  
  <section class="content-header">
      <h1>
        Compose
        <button type="button" data-toggle="modal" data-target="#modal-compose-sms-manual" class="btn btn-info btn-sm" title="manual">Help</button> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/messages/create">Messages</a></li>
        <li class="active">Compose SMS</li>
      </ol>
    </section>

    <section class="content" >
      <div class="row">
       
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Existing</a></li>
              <li><a href="#timeline" data-toggle="tab">Anonymous</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">    
       
                  <form role="form" action="{{route('messages.store')}}" method="post">
                  {{csrf_field()}}
                    <div class="box-body">
                      <div class="form-group">
                        @if(Auth::user()->user_level != 'Client')  
                          <select class="form-control select2" style="width: 100%;" name="client">
                        @else
                          <select class="form-control select2" style="width: 100%;" name="client" disabled>
                        @endif
                            <option>Client:</option>
                            @if(Auth::user()->user_level != 'Client')
                              @foreach($clients as $client)
                              <option value="{{$client->id}}">{{$client->client_code}} - {{$client->name}}</option>
                              @endforeach
                            @else
                              @foreach($clients as $client)
                                @if($client->id == Auth::user()->id)
                                <option value="{{$client->id}}" Selected>{{$client->client_code}} - {{$client->name}}</option>
                                @endif
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <div class="form-group">
                          <select class="form-control select2" multiple="multiple" data-placeholder="Recipient:"
                                style="width: 100%;" name="contact[]" id="contact">
                            @if(Auth::user()->user_level != 'Client')
                              @foreach($contacts as $contact)
                                <option value="{{$contact->id}}">{{$contact->client_code}} - {{$contact->name}} - {{$contact->contact_no}}</option>
                              @endforeach
                            @else
                              @foreach($contacts as $contact)
                                @if($contact->client_code == Auth::user()->client_code)
                                  <option value="{{$contact->id}}">{{$contact->client_code}} - {{$contact->name}} - {{$contact->contact_no}}</option>
                                @endif
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Message</label>
                          <textarea placeholder="Message"
                                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" maxlength="150" name="message"></textarea>
                      </div>
                      <input type="hidden" name="user_id" value="{{$data->id}}">
                      
                    </div>
                    <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                  </div>
                  </form>
                </div>
              
              <div class="tab-pane" id="timeline">
                  <form role="form" action="{{url('/messages/anonymous')}}" method="post">
                  {{csrf_field()}}
                    <div class="box-body">
                      <div class="form-group">
                        @if(Auth::user()->user_level != 'Client')
                          <select class="form-control select2" style="width: 100%;" name="client">
                        @else
                          <select class="form-control select2" style="width: 100%;" name="client" disabled>
                        @endif
                            <option>Client:</option>
                            @if(Auth::user()->user_level != 'Client')
                              @foreach($clients as $client)
                              <option value="{{$client->id}}">{{$client->client_code}} - {{$client->name}}</option>
                              @endforeach
                            @else
                              @foreach($clients as $client)
                                @if($client->id == Auth::user()->id)
                                <option value="{{$client->id}}" Selected>{{$client->client_code}} - {{$client->name}}</option>
                                @endif
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <div class="form-group">
                          <input type="number" name="contact" placeholder="Recipient:" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Message</label>
                          <textarea placeholder="Message"
                                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" maxlength="150" name="message"></textarea>
                      </div>
                      <input type="hidden" name="user_id" value="{{$data->id}}">
                      
                    </div>
                    <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                  </div>
                  </form>
              </div>
              
            </div>
            
          </div>
          
        </div>
         
      </div>
    </section>

@endsection