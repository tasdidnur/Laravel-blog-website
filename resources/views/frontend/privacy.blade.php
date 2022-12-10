@extends('layouts.front')
@section('content')
<!-- Start Post Single Wrapper  -->
<div class="axil-privacy-area axil-section-gap bg-color-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="content">
                    <div class="inner">
                        <div class="section-title">
                            <h4 class="title">{{ $privacy->page_subtitle }}</h4>
                        </div>
                        {!! $privacy->page_description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Post Single Wrapper  -->
@endsection