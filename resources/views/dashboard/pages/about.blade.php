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
              <li class="breadcrumb-item active">About Us Page Edit</li>
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
            <h3 class="card-title">Edit About Us page</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/page/update') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="editor">Editor</label>
                      <input type="text" name="" class="form-control" id="" value="{{ optional($data->editor_info)->name }}" disabled>
                    </div>
                    <div class="col-lg-6">
                      <label for="edited">Edited At</label>
                      <input type="text" name="" class="form-control" id="" value="{{ optional($data->updated_at)->format('d-m-Y || h-i-s A') }}" disabled>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}}">
                    <label for="title">Title<span style="color:red;">*</span></label>
                    <input type="hidden" name="id" value="{{ $data->page_id }}">
                    <input type="text" name="title" class="form-control" id="title" value="{{ $data->page_title }}">
                    @if ($errors->has ('title'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('title')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('subtitle') ? ' has-error' : ''}}">
                    <label for="subtitle">Subtitle<span style="color:red;">*</span></label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{ $data->page_subtitle }}">
                    @if ($errors->has ('subtitle'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('subtitle')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Background Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      @if($data->back_image!='')
                      <img width="200" height="120" src='{{ asset('uploads/pages/'.$data->back_image) }}' alt="post">
                        @else
                      <img width="100" height="100" src='{{ asset('uploads/users/ava.png') }}' alt="post">
                       @endif
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('desc') ? ' has-error' : ''}}">
                    <label for="desc">Page Description<span style="color:red;">*</span></label>
                    <textarea rows="5" name="desc" class="form-control" id="summernote">{{ $data->page_description }}</textarea>
                    @if ($errors->has ('desc'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('desc')}}</strong>
                     </span>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Update</button>
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
