@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Users Status</h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users Status</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="box box-primary">
            <div class="box-body">
              
              <div class="table-responsive mailbox-messages">
              @if(session()->get('user_level') != 'Client')
                @if(Auth::user()->status == '2')
                  <a title="turn break off" href="{{url('/status',[1])}}" class="btn btn-info btn-flat"> Break <span class="fa fa-toggle-on"></span></a>
                  <a title="turn snack on" href="{{url('/status',[3])}}" class="btn btn-info btn-flat"> Snack <span class="fa fa-toggle-off"></span></a>
                @elseif(Auth::user()->status == '3')
                  <a title="turn break on" href="{{url('/status',[2])}}" class="btn btn-info btn-flat"> Break <span class="fa fa-toggle-off"></span></a>
                  <a title="turn snack off" href="{{url('/status',[1])}}" class="btn btn-info btn-flat"> Snack <span class="fa fa-toggle-on"></span></a>
                @else
                  <a title="turn break on" href="{{url('/status',[2])}}" class="btn btn-info btn-flat"> Break <span class="fa fa-toggle-off"></span></a>
                  <a title="turn snack on" href="{{url('/status',[3])}}" class="btn btn-info btn-flat"> Snack <span class="fa fa-toggle-off"></span></a>
                @endif
              @endif
                <br><br><br>
              <table id="example5" class="table table-bordered table-striped">
                <thead style="font-size:12px">
                <tr>
                  <th>No</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Username</th>
                  @if(session()->get('user_level') != 'Client')
                  <th>Telephone</th>
                  @endif
                  <th>Email</th>
                  <th>User Role</th>
                  
                </tr>
              </thead>
              <tbody style="font-size:12px">
                <?php $c = 1; ?>
                @foreach($data as $object)
                <tr>
                  
                  <td>{{$c}}</td>
                  @if($object->status == '1')
                  <td><i class="in">IN</i></td>
                  @elseif($object->status == '2')
                  <td><i class="in">BREAK</i></td>
                  @elseif($object->status == '3')
                  <td><i class="in">SNACK</i></td>
                  @else
                  <td><i class="out">OUT</i></td>
                  @endif

                  @if($object->id == session()->get('user_id') && $object->user_level == 'Client')
                  <td><a href="{{url('/clients/client-profile',[$object->id])}}" title="view my profile"><b>
                  {{$object->name}}</b></a></td>
                  @elseif($object->id == session()->get('user_id'))
                  <td><a href="{{url('profile')}}" title="view my profile"><b>{{$object->name}}</b></a></td>
                  @elseif($object->user_level == 'Client')
                  <td><a href="{{url('/clients/client-profile',[$object->id])}}" title="view client profile">{{$object->name}}</a></td>
                  @else
                  <td><a title="view profile" href="{{url('/admin/staff-profile',[$object->id])}}">{{$object->name}}</a></td>
                  @endif
                  <td>{{$object->username}}</td>
                  @if(session()->get('user_level') != 'Client')
                  <td>{{$object->telephone}}</td>
                  @endif
                  <td>{{$object->email}}</td>
                  <td>{{$object->user_level}}</td>
                </tr>
                  <?php $c++; ?>
                @endforeach
              </tbody>
              </table>
              </div>
            </div>
          </div>
  </section>
@endsection