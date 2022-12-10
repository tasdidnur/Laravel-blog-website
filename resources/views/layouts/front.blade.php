<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('website/assets')}}/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/vendor/slick.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/vendor/base.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/plugins/plugins.css">
    <link rel="stylesheet" href="{{asset('website/assets')}}/css/style.css">
    <!-- jQuery JS -->
    <script src="{{asset('website/assets')}}/js/vendor/jquery.js"></script>
</head>
<body>
    <div class="main-wrapper">
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <div id="my_switcher" class="my_switcher">
            <ul>
                <li>
                    <a href="javascript: void(0);" data-theme="light" class="setColor light">
                        <span title="Light Mode">Light</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                        <span title="Dark Mode">Dark</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Start Header -->
        <header class="header axil-header  header-light header-sticky header-with-shadow">
            <div class="header-wrap">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3 col-12">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img class="dark-logo" src="{{asset('uploads/setting')}}/{{ $setting->dark_logo }}" alt="logo">
                                <img class="light-logo" src="{{asset('uploads/setting')}}/{{ $setting->light_logo }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <div class="mainmenu-wrapper">
                            <nav class="mainmenu-nav">
                                <!-- Start Mainmanu Nav -->
                                <ul class="mainmenu">
                                    <li class="menu-item-has-children"><a href="{{ url('/') }}">Home</a> </li>
                                    @foreach ($categorys as $category)
                                    <li class="menu-item-has-children"><a href="{{ url('category/'.$category->cat_slug) }}">{{ $category->cat_name }}</a> </li>
                                    @endforeach
                                </ul>
                                <!-- End Mainmanu Nav -->
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-8 col-md-8 col-sm-9 col-12">
                        <div class="header-search text-end d-flex align-items-center">
                            <form action="{{ url('/search') }}" method="get" class="header-search-form d-sm-block d-none">
                                @csrf
                                <div class="axil-search form-group">
                                    <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                </div>
                            </form>
                            <div class="mobile-search-wrapper d-sm-none d-block">
                                <button class="search-button-toggle"><i class="fal fa-search"></i></button>
                                <form action="{{ url('/search') }}" method="get" class="header-search-form">
                                    @csrf
                                    <div class="axil-search form-group">
                                        <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                        <input type="text" name="search" class="form-control" placeholder="Search">
                                    </div>
                                </form>
                            </div>
                            <!-- Start Hamburger Menu  -->
                            <div class="hamburger-menu d-block d-xl-none">
                                <div class="hamburger-inner">
                                    <div class="icon"><i class="fal fa-bars"></i></div>
                                </div>
                            </div>
                            <!-- End Hamburger Menu  -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Start Header -->
        <!-- Start Mobile Menu Area  -->
        <div class="popup-mobilemenu-area">
            <div class="inner">
                <div class="mobile-menu-top">
                    <div class="logo">
                        <a href="index.html">
                            <img class="dark-logo" src="{{asset('uploads/setting')}}/{{ $setting->dark_logo }}" alt="Logo">
                            <img class="light-logo" src="{{asset('uploads/setting')}}/{{ $setting->light_logo }}" alt="Logo">
                        </a>
                    </div>
                    <div class="mobile-close">
                        <div class="icon">
                            <i class="fal fa-times"></i>
                        </div>
                    </div>
                </div>
                <ul class="mainmenu">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @foreach ($categorys as $category)
                    <li><a href="{{ url('category/'.$category->cat_slug) }}">{{ $category->cat_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- End Mobile Menu Area  -->
    </div>    
        @yield('content')
        <!-- Start Footer Area  -->
    <div class="main-wrapper">    
        <div class="axil-footer-area axil-footer-style-1 footer-variation-2">
            <!-- Start Footer Top Area  -->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img class="dark-logo" src="{{asset('uploads/setting')}}/{{ $setting->dark_logo }}" alt="Logo Images">
                                    <img class="white-logo" src="{{asset('uploads/setting')}}/{{ $setting->light_logo }}" alt="Logo Images">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <!-- Start Post List  -->
                            <div class="d-flex justify-content-start mt_sm--15 justify-content-md-end align-items-center flex-wrap">
                                <h5 class="follow-title mb--0 mr--20">Follow Us</h5>
                                <ul class="social-icon color-tertiary md-size justify-content-start">
                                    <li><a target="_blank" href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                    <li><a target="_blank" href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank" href="{{ $setting->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <!-- End Post List  -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Footer Top Area  -->
            <!-- Start Copyright Area  -->
            <div class="copyright-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-md-4">
                            <div class="copyright-left">
                                <ul class="mainmenu justify-content-start">
                                    <li>
                                        <a class="hover-flip-item-wrapper" href="{{ url('/about') }}">
                                            <span class="hover-flip-item">
                                        <span data-text="About Us">About Us</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="hover-flip-item-wrapper" href="{{ url('/contact') }}">
                                            <span class="hover-flip-item">
                                        <span data-text="Contact Us">Contact Us</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="hover-flip-item-wrapper" href="{{ url('/privacy-policy') }}">
                                            <span class="hover-flip-item">
                                        <span data-text="Privacy Policy">Privacy Policy</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="copyright-right text-start text-md-end mt_sm--20">
                                <p class="b3">Devoloped by Tasdid Nur Nibir. <br>{{ $setting->copyright }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Copyright Area  -->
        </div>
        <!-- End Footer Area  -->
        <!-- Start Back To Top  -->
        <a id="backto-top"></a>
        <!-- End Back To Top  -->
    </div>
    <!-- Modernizer JS -->
    <script src="{{asset('website/assets')}}/js/vendor/modernizr.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="{{asset('website/assets')}}/js/vendor/bootstrap.min.js"></script>
    <script src="{{asset('website/assets')}}/js/vendor/slick.min.js"></script>
    <script src="{{asset('website/assets')}}/js/vendor/tweenmax.min.js"></script>
    <script src="{{asset('website/assets')}}/js/vendor/js.cookie.js"></script>
    <script src="{{asset('website/assets')}}/js/vendor/jquery.style.switcher.js"></script>
    <!-- Main JS -->
    <script src="{{asset('website/assets')}}/js/main.js"></script>
    
</body>
</html>