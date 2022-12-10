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
              <li class="breadcrumb-item"><a href="{{ url('dashboard/messeges') }}">All Messages</a></li>
              <li class="breadcrumb-item active">View Message</li>
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
      <div class="col-1"></div>
      <div class="col-10">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">View Message Information</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                   <a class="btn btn-block btn-primary" href="#" id="softDelete" data-toggle="modal" data-target="#modal-danger" data-id={{ $data->message_id }}>Delete This Message</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover text-nowrap">
              <tbody>
                <tr>
                  <td style="width:25%;">Sender Name</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->name }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Sender Email</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->email }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Sender Phone</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->phone }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Sender Message</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->message }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Sended At</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">
                    @if($data->created_at!="")
                    {{ $data->created_at->format('d-m-Y || h-i-s A') }}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-1"></div>

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
