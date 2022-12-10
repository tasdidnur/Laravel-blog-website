@extends('layouts.front')
@section('content')
        <!-- Start Banner Area  -->
        <div class="axil-banner banner-style-1 bg_image" style="background-image:url({{ asset('uploads/pages/'.$contact->back_image) }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner">
                            <h1 class="title">{{ $contact->page_title }}</h1>
                            <p class="description">{{ $contact->page_subtitle }}</p>
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
                                {!! $contact->page_description !!}
                            </div>
                            <!-- Start Contact Form  -->
                            <div class="axil-section-gapTop axil-contact-form-area">
                                <h4 class="title mb--10">Send Us a Message</h4>
                                <p class="b3 mb--30">Your email address will not be published. All the fields are required.</p>
                                {{-- @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('success')}}
                                </div>
                                @endif
                                @if(Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('error')}}
                                </div>
                                @endif --}}
                                <div class="alert alert-success d-none" id="msg_div">
                                    <span id="res_message"></span>
                                </div>
                                <form method="POST" enctype="multipart/form-data" id="contactForm" class="axil-contact-form contact-form--1 row">
                                    @csrf
                                    <div class="col-lg-4 col-md-4 col-12 {{ $errors->has('name') ? ' has-error' : ''}}">
                                        <div class="form-group">
                                            <label for="name">Your Name<span style="color:red;">*</span></label>
                                            <input name="name" id="name" type="text" value="{{ old('name') }}">
                                            <span class="text-danger" id="nameError"></span>
                                            {{-- @if ($errors->has ('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('name')}}</strong>
                                                </span>
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 {{ $errors->has('email') ? ' has-error' : ''}}">
                                        <div class="form-group">
                                            <label>Your Email<span style="color:red;">*</span></label>
                                            <input for="email" name="email" id="email" type="email" value="{{ old('email') }}">
                                            <span class="text-danger" id="emailError"></span>
                                            {{-- @if ($errors->has ('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('email')}}</strong>
                                                </span>
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-12 {{ $errors->has('message') ? ' has-error' : ''}}">
                                        <div class="form-group">
                                            <label for="message">Your Message<span style="color:red;">*</span></label>
                                            <textarea name="message" id="message">{{ old('message') }}</textarea>
                                            <span class="text-danger" id="messageError"></span>
                                            {{-- @if ($errors->has ('message'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('message')}}</strong>
                                                </span>
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-submit">
                                            <button type="submit" class="axil-button button-rounded btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Contact Form  -->
                        </div>
                        <!-- End About Area  -->
                    </div>
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
        <script>
            $('#contactForm').on('submit',function(event){
                event.preventDefault();
                // get all text id
                name = $('#name').val();
                phone = $('#phone').val();
                email = $('#email').val();
                message = $('#message').val();
    
                $.ajax({
                    url: "/contactmessage", //Define Post URL
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        email:email,
                        phone:phone,
                        message:message,
                    },
                    //Display Response Success Message
                    success: function(response){
                    $('#nameError').text('');    
                    $('#emailError').text('');    
                    $('#messageError').text('');    
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');
                
                    document.getElementById("contactForm").reset();
                    setTimeout(function(){
                    $('#res_message').hide();
                    $('#msg_div').hide();
                    },8000);
                    },
                    error: function(error){
                        $('#nameError').text(error.responseJSON.errors.name);
                        $('#emailError').text(error.responseJSON.errors.email);
                        $('#messageError').text(error.responseJSON.errors.message);
                    },
                });
            });
        </script>
        <!-- End Post List Wrapper  -->  
@endsection