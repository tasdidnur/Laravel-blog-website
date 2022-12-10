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
              <li class="breadcrumb-item"><a href="{{ url('dashboard/categorys') }}">Tags</a></li>
              <li class="breadcrumb-item active">{{ $data->tag_name }}</li>
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
            <h3 class="card-title">View Tag Information</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/tags') }}">All Tags</a>
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover text-nowrap">
              <tbody>
                <tr>
                  <td style="width:25%;">Tag Name</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->tag_name }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Tag Description</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">{{ $data->tag_description }}</td>
                </tr>
                <tr>
                  <td style="width:25%;">Tag creator</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">
                    @if($data->tag_creator!="")
                    {{ $data->creator_info->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td style="width:25%;">Created At</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">
                    @if($data->created_at!="")
                    {{ $data->created_at->format('d-m-Y || h-i-s A') }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td style="width:25%;">Tag Editor</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">
                    @if($data->tag_editor!="")
                    {{ $data->editor_info->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td style="width:25%;">Updated At</td>
                  <td style="width:5%;">:</td>
                  <td style="width:70%;">
                    @if($data->updated_at!="")
                    {{ $data->updated_at->format('d-m-Y || h-i-s A') }}
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
  @endsection
