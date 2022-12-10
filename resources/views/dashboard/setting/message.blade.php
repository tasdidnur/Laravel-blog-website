@extends('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Messeges</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
      </div>
      @endif
      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
      </div>
      @endif
    </div>
    <div class="col-2"></div>
  </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Messeges</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table id="myTable" class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Sended At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($message as $data)
                <tr>
                  <td>
                    @if($i<'10')
                    0{{ $i++ }}
                    @else
                     {{ $i++ }}
                    @endif
                  </td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->phone }}</td>
                  <td>{{ Str::limit($data->message,20) }}</td>
                  <td>{{ $data->created_at->format('d-m-Y || h-i-s A') }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">Manage </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ url('dashboard/messege/'.$data->message_id) }}">View</a>
                        <a href="#" class="dropdown-item btn btn-danger" id="softDelete" data-toggle="modal" data-target="#modal-danger" data-id={{ $data->message_id }}>Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content-wrapper -->


  <!-- /.modal -->
     <div class="modal fade" id="modal-danger">
      <div class="modal-dialog">
        <form method="post" action="{{url('dashboard/deleteMessage')}}">
          @csrf
        <div class="modal-content bg-danger">
          <div class="modal-header">
            <h4 class="modal-title">Do you want to sure delete?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body modal_body">
            <p>Press the CONFIRM button to delete.</p>
            <input type="hidden" name="modal_id" id='modal_id' value="1">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-outline-light">CONFIRM</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    <!-- /.modal -->
  @endsection
