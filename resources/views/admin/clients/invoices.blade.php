@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Clients Invoices
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/invoices">Reports</a></li>
        <li class="active">Invoices</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
            <div class="mailbox-controls">
                
               
                
              </div>
              <div class="table-responsive mailbox-messages">
              <table id="example2" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  
                  <th>No</th>
                  <th>Name</th>
                  <th>Month Year</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource' || session()->get('user_level')=='Client')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($clients as $object)
                <tr>
                  
                  <td><a href="#"></a>  {{$c}}</td>
                  <td><a href="{{url('/clients/client-profile',[$object->client_id])}}">{{$object->client_name}}</a></td>
                  <td>{{date('F, Y',strtotime($object->created_at))}}</td>
                 

                  <!-- this condition is to check the user level to control the priviledge of the user currently logged in -->
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource' || session()->get('user_level')=='Client')
                  <td>
                     <!--  <a href="/clients/{{$object->id}}/edit" class="btn btn-primary btn-xs" title="Download PDF"><i class="fa fa-arrow-down"> </i></a> -->
                      <a href="/clients/invoice/{{$object->identifier}}" class="btn btn-info btn-xs" title="View Invoice"><i class="fa fa-eye"> </i></a>
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