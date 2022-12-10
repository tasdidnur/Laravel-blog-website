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
              <li class="breadcrumb-item active">Tags</li>
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
            <h3 class="card-title">All Tags</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/tag/add') }}">Add Tag</a>
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
                  <th>Tag Name</th>
                  <th>Tag Description</th>
                  <th>Posts</th>
                  <th>Tag Creator</th>
                  <th>Tag Editor</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($allUser as $data)
                <tr>
                  <td>
                    @if($i<'10')
                    0{{ $i++ }}
                    @else
                     {{ $i++ }}
                    @endif
                  </td>
                  <td>{{ $data->tag_name }}</td>
                  <td>{{ $data->tag_description }}</td>
                  <td>{{ $data->posts->count() }}</td>
                  <td>
                    @if($data->tag_creator!="")
                    {{ $data->creator_info->name }}
                    @endif
                  </td>
                  <td>
                    @if($data->tag_editor!="")
                    {{ $data->editor_info->name }}
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">Manage </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ url('dashboard/tag/view/'.$data->tag_slug) }}">View</a>
                        <a class="dropdown-item" href="{{ url('dashboard/tag/edit/'.$data->tag_slug) }}">Edit</a>
                        <a href="#" class="dropdown-item btn btn-danger" id="softDelete" data-toggle="modal" data-target="#modal-danger" data-id={{ $data->tag_id }}>Delete</a>
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
        <form method="post" action="{{url('dashboard/tag/softdelete')}}">
          @csrf
        <div class="modal-content bg-danger">
          <div class="modal-header">
            <h4 class="modal-title">Do you want to delete?</h4>
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
