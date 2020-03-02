@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Won Clients
        <button type="button" data-toggle="modal" data-target="#modal-won-clients-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/won_index">People</a></li>
        <li class="active">Won Clients</li>
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
                  <!-- <th>Box</th> -->
                  <th>No</th>
                  <th>Name</th>
                  <th>Contact Person</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Service</th>
                  <th>Rate/SMS</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($clients as $object)
                <tr>
                  <!-- <td><input type="checkbox" name="client_checkbox[]" class="client_checkbox" value="{{$object->id}}"></td> -->
                  <td><a href="#"><i class="fa fa-star text-yellow"></i></a>  {{$c}}</td>
                  <td><a href="{{url('/clients/client-profile',[$object->id])}}">{{$object->name}}</a></td>
                  <td>{{$object->contact_person}}</td>
                  <td>{{$object->contact_number}}</td>
                  <td><a href="{{$object->email}}">{{$object->email}}</a></td>
                  <td>{{$object->service}}</td>
                  <td>{{$object->rateperhour}}</td>

                  <!-- this condition is to check the user level to control the priviledge of the user currently logged in -->
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      
                      <a href="/clients/{{$object->id}}/edit" class="btn btn-info btn-xs" title="edit"><i class="fa fa-edit"> </i></a>

                      <a href="/clients/{{$object->id}}/lost" class="btn btn-danger btn-xs" title="lost"><i class="fa fa-remove"> </i></a>
                      <!-- <a href="{{url('/admin/delete-client',[$object->id])}}" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Are you sure you want to delete this client? all it\'s contacts will be deleted too ')" ><i class="fa fa-trash-o"></i></a> -->
                  </td>

                  @endif
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