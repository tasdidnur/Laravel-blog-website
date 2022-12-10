@extends('layouts.front')
@section('content')
        <!-- Start Post List Wrapper  -->
        <div class="axil-post-list-area axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 page_nation">
                        <!-- Start Post List  -->
                        <!-- End Post List  -->
                        @forelse ($query as $post)

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
                                                <a class="hover-flip-item-wrapper">
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
                        @empty
                        <h4 class="title">Sorry! No post found on your search.</h4>
                        <!-- End Post List  -->
                        @endforelse
                        {{$query->links()}}
                    </div>
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
        <!-- End Post List Wrapper  -->
    
@endsection