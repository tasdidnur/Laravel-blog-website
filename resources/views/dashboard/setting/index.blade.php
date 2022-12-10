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
              <li class="breadcrumb-item active">Settings</li>
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
      <div class="col-lg-1"></div>
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">settings</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/setting/update') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Dark Logo</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="dark_logo" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                            @if($data->dark_logo!='')
                            <img width="267" height="70" src='{{ asset('uploads/setting/'.$data->dark_logo) }}'>
                            @else
                            <img width="100" height="100" src='{{ asset('uploads/users/ava.png') }}'>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Light Logo</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="light_logo" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                            @if($data->light_logo!='')
                            <img class="bg-dark" width="267" height="70" src='{{ asset('uploads/setting/'.$data->light_logo) }}'>
                            @else
                            <img width="100" height="100" src='{{ asset('uploads/users/ava.png') }}'>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('facebook') ? ' has-error' : ''}}">
                        <label for="facebook">Facebook<span style="color:red;">*</span></label>
                        <input type="hidden" name="id" value="{{ $data->setting_id }}">
                        <input type="text" name="facebook" class="form-control" id="name" value="{{ $data->facebook }}">
                        @if ($errors->has ('facebook'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('facebook')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('twitter') ? ' has-error' : ''}}">
                        <label for="twitter">Twitter<span style="color:red;">*</span></label>
                        <input type="text" name="twitter" class="form-control" id="twitter" value="{{ $data->twitter }}">
                        @if ($errors->has ('twitter'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('twitter')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('instagram') ? ' has-error' : ''}}">
                        <label for="instagram">Instagram<span style="color:red;">*</span></label>
                        <input type="text" name="instagram" class="form-control" id="name" value="{{ $data->instagram }}">
                        @if ($errors->has ('instagram'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('instagram')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('youtube') ? ' has-error' : ''}}">
                        <label for="youtube">Youtube<span style="color:red;">*</span></label>
                        <input type="text" name="youtube" class="form-control" id="youtube" value="{{ $data->youtube }}">
                        @if ($errors->has ('youtube'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('youtube')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('pinterest') ? ' has-error' : ''}}">
                        <label for="pinterest">Pinterest<span style="color:red;">*</span></label>
                        <input type="text" name="pinterest" class="form-control" id="name" value="{{ $data->pinterest }}">
                        @if ($errors->has ('pinterest'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('pinterest')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('linkedin') ? ' has-error' : ''}}">
                        <label for="linkedin">linkedin<span style="color:red;">*</span></label>
                        <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{ $data->linkedin }}">
                        @if ($errors->has ('linkedin'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('linkedin')}}</strong>
                         </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('copyright') ? ' has-error' : ''}}">
                    <label for="copyright">Copyright<span style="color:red;">*</span></label>
                    <input type="text" name="copyright" class="form-control" id="copyright" value="{{ $data->copyright }}">
                    @if ($errors->has ('copyright'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('copyright')}}</strong>
                     </span>
                    @endif
                  </div>
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
      <div class="col-lg-1"></div>
    </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
