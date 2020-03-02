@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>
        Applicants
        <button type="button" data-toggle="modal" data-target="#modal-applicants-manual" class="btn btn-info btn-sm" title="manual">Help</button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/files">People</a></li>
        <li class="active">Applicants</li>
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
                  <th>Preferred Job</th>
                  <th>Title</th>
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody style="font-size:11px">
                <?php $c = 1; ?>
                @foreach($files as $object)
                <tr>
                  <td>{{$c}}</td>
                  <td>{{$object->name}}</td>
                  <td>{{$object->job}}</td>
                  <td>{{$object->filename}}</td>

                  <!-- this condition is to check the user level to control the priviledge of the user currently logged in -->
                  @if(session()->get('user_level')=='Admin' || session()->get('user_level')=='Human Resource')
                  <td>
                      <a href="{{ route('downloadfile', $object->id)}}" class="btn btn-primary btn-xs" title="download"><i class="fa fa-cloud-download"></i></a>

                      <a href="{{ route('deletefile', $object->id)}}" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Are you sure you want to delete this file?')" ><i class="fa fa-trash-o"></i></a>
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