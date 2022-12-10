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
              <li class="breadcrumb-item active">Post Edit</li>
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
            <h3 class="card-title">Edit Post</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/posts') }}">All Post</a>
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/post/update') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}}">
                    <label for="title">Post Title<span style="color:red;">*</span></label>
                    <input type="hidden" name="id" value="{{ $data->post_id }}">
                    <input type="text" name="title" class="form-control" id="title" value="{{ $data->post_title }}">
                    @if ($errors->has ('title'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('title')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('category') ? ' has-error' : ''}}">
                    <label for="category">Category<span style="color:red;">*</span></label>
                    <select name="category" class="custom-select rounded-0" id="category">
                      <option value="">Select Category</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->cat_id }}" @if($cat->cat_id==$data->cat_id) selected @else '' @endif>{{ $cat->cat_name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has ('category'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('category')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      @if($data->post_image!='')
                      <img width="100" height="100" src='{{ asset('uploads/posts/'.$data->post_image) }}' alt="post"></img>
                        @else
                      <img width="100" height="100" src='{{ asset('uploads/users/ava.png') }}' alt="post"></img>
                       @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Post Tags</label>
                    <div class="input-group">
                      <div class="form-group d-flex">
                        @foreach($tags as $tag)
                        <div class="form-check" style="margin-right:10px;">
                          <input class="form-check-input" name="tags[]" id="tag{{ $tag->tag_id }}" type="checkbox" value="{{ $tag->tag_id }}"
                          @foreach($data->tags as $t)
                              @if($tag->tag_id == $t->tag_id) checked @endif
                          @endforeach
                          >
                          <label for="tag{{ $tag->tag_id }}" class="form-check-label">{{ $tag->tag_name }}</label>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('desc') ? ' has-error' : ''}}">
                    <label for="desc">Post Description<span style="color:red;">*</span></label>
                    <textarea rows="5" name="desc" class="form-control" id="summernote">{{ $data->post_description }}</textarea>
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
