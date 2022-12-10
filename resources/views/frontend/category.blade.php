@extends('layouts.front')
@section('content')
        <!-- Start Post List Wrapper  -->
        <div class="axil-post-list-area axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 page_nation">
                        <!-- Start Post List  -->
                        <div class="content-block post-list-view sticky mt--30">
                            <div class="post-content">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a class="hover-flip-item-wrapper" href="{{ url('category/'.$category->cat_slug) }}">
                                            <span class="hover-flip-item">
                                                <span data-text="{{ $category->cat_name }}">{{ $category->cat_name }}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="title"><a href="{{ url('category/'.$category->cat_slug) }}">{{ $category->cat_description }}</a></h4>
                                <div class="post-meta-wrapper">
                                    <div class="post-meta">
                                        <div class="content">
                                            <h6 class="post-author-name">
                                                <a class="hover-flip-item-wrapper" href="author.html">
                                                    <span class="hover-flip-item">
                                                        <span data-text="{{ optional($category->creator_info)->name }}">{{ optional($category->creator_info)->name }}</span>
                                                    </span>
                                                </a>
                                            </h6>
                                            <ul class="post-meta-list">
                                                <li>{{ optional($category->created_at)->format('M d, Y') }}</li>
                                                <li>3 min read</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="social-share-transparent justify-content-end">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fas fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Post List  -->
                        @if (count($posts)>0)
                        @foreach ($posts as $post)

                        <!-- Start Post List  -->
                        <div class="content-block post-list-view mt--30">
                            <div class="post-thumbnail">
                                <a href="{{ url('post/'.$post->post_slug) }}">
                                    @if($post->post_image!='')
                                     <img src='{{ asset('uploads/posts/'.$post->post_image) }}' alt="Post Images">
                                    @else
                                     <img src='{{ asset('uploads/users/ava.png') }}' alt="Post Images">
                                    @endif
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a class="hover-flip-item-wrapper" href="{{ url('category/'.$post->postCategory->cat_slug) }}">
                                            <span class="hover-flip-item">
                                                <span data-text="{{ optional($post->postCategory)->cat_name }}">{{ optional($post->postCategory)->cat_name }}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="title"><a href="{{ url('post/'.$post->post_slug) }}">{{ $post->post_title }}</a></h4>
                                <div class="post-meta-wrapper">
                                    <div class="post-meta">
                                        <div class="content">
                                            <h6 class="post-author-name">
                                                <a class="hover-flip-item-wrapper" >
                                                    <span class="hover-flip-item">
                                                        <span data-text="{{ optional($post->creator_info)->name }}">{{ optional($post->creator_info)->name }}</span>
                                                    </span>
                                                </a>
                                            </h6>
                                            <ul class="post-meta-list">
                                                <li>{{ optional($post->created_at)->format('M d, Y') }}</li>
                                                <li>3 min read</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="social-share-transparent justify-content-end">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fas fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Post List  -->
                        @endforeach
                        @else
                        <h4 class="title" style="margin-top: 20px;">No posts to show.</h4>
                        @endif
                        {{$posts->links()}}
                    </div>
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
        <!-- End Post List Wrapper  -->
    
@endsection