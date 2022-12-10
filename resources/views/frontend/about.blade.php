@extends('layouts.front')
@section('content')
<!-- Start Banner Area  -->
<div class="axil-banner banner-style-1 bg_image" style="background-image:url({{ asset('uploads/pages/'.$about->back_image) }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner">
                    <h1 class="title">{{ $about->page_title }}</h1>
                    <p class="description">{{ $about->page_subtitle }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Area  -->

<!-- Start Post List Wrapper  -->
<div class="axil-post-list-area axil-section-gap bg-color-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-8">
                <!-- Start About Area  -->
                <div class="axil-about-us">
                    <div class="inner">
                        {!! $about->page_description !!}
                    </div>
                </div>
                <!-- End About Area  -->
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
</div>
<!-- End Post List Wrapper  -->
@endsection