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
              <li class="breadcrumb-item active">Posts</li>
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
            <h3 class="card-title">All Posts</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/post/add') }}">Add Post</a>
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
                  <th>Post Title</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Tags</th>
                  @if (Auth::user()->role==1 || Auth::user()->role==2)
                  <th>Status</th>
                  @endif
                  <th>Views</th>
                  <th>Author</th>
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
                  <td>{{ Str::limit($data->post_title,30) }}</td>
                  <td>@if($data->post_image!='')
                    <img width="50" height="50" src='{{ asset('uploads/posts/'.$data->post_image) }}' alt="post"></img>
                      @else
                    <img width="50" height="50" src='{{ asset('uploads/users/ava.png') }}' alt="post"></img>
                       @endif
                  </td>
                  <td>{{ $data->postCategory->cat_name }}</td>
                  <td>
                    @foreach($data->tags as $tag)
                      <span class="badge badge-primary">{{ $tag->tag_name }}</span>
                    @endforeach
                  </td>
                  @if (Auth::user()->role==1 || Auth::user()->role==2)
                  <td>
                    @if ($data->approve_status==0)
                     <a class="btn-sm btn-danger" href="{{ url('dashboard/post/satus/'.$data->post_slug) }}">PENDING</a>
                    @else
                    <a class="btn-sm btn-success" href="{{ url('dashboard/post/satus/'.$data->post_slug) }}">APPROVED</a>
                    @endif 
                  </td>
                  @endif
                  <td>
                    {{ $data->view_count }}
                  </td>
                  <td>
                    @if($data->post_creator!="")
                    {{ $data->creator_info->name }}
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">Manage </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ url('dashboard/post/view/'.$data->post_slug) }}">View</a>
                        <a class="dropdown-item" href="{{ url('dashboard/post/edit/'.$data->post_slug) }}">Edit</a>
                        <a href="#" class="dropdown-item btn btn-danger" id="softDelete" data-toggle="modal" data-target="#modal-danger" data-id={{ $data->post_id }}>Delete</a>
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
        <form method="post" action="{{url('dashboard/post/softdelete')}}">
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
