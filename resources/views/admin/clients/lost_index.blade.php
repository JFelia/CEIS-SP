@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Lost Clients
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/lost_index">People</a></li>
        <li class="active">Lost Clients</li>
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
                  <th>Contact Person</th>
                  <th>Phone</th>
                  <th>Email</th>
                  
                 
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($clients as $object)
                <tr>
                  
                  <td><a href="#"></a>  {{$c}}</td>
                  <td><a href="{{url('/clients/client-profile',[$object->id])}}">{{$object->name}}</a></td>
                  <td>{{$object->contact_person}}</td>
                  <td>{{$object->contact_number}}</td>
                  <td><a href="{{$object->email}}">{{$object->email}}</a></td>
                 
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