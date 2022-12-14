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
              <li class="breadcrumb-item active">Category Resgistration</li>
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
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Register Category</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/categorys') }}">All Category</a>
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/category/submit') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group {{ $errors->has('name') ? ' has-error' : ''}}">
                    <label for="name">Category Name<span style="color:red;">*</span></label>
                    <input type="name" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    @if ($errors->has ('name'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('name')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('desc') ? ' has-error' : ''}}">
                    <label for="desc">Category Description<span style="color:red;">*</span></label>
                    <input type="text" name="desc" class="form-control" id="desc" value="{{ old('desc') }}">
                    @if ($errors->has ('desc'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('desc')}}</strong>
                     </span>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-lg-2"></div>
    </div>
    </div>
    <!-- /.row -->



  </div>
  <!-- /.content-wrapper -->
  @endsection
