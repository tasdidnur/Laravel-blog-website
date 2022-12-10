<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  	<title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('website/assets')}}/images/favicon.png">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="{{asset('log-in')}}/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Login Page</h3>
            <!-- Session Status -->
           <x-auth-session-status class="mb-4" :status="session('status')" />

           <!-- Validation Errors -->
           <x-auth-validation-errors class="mb-4" :errors="$errors" />
						<form method="POST" action="{{ route('login') }}" class="login-form">
              @csrf
		      		<div class="form-group">
                <label class="label" for="email" :value="__('Email')">Email</label>
		      			<input id="email" type="email" class="form-control rounded-left" name="email" :value="old('email')" required autofocus>
		      		</div>
	            <div class="form-group">
                <label class="label" for="password" :value="__('Password')">Password</label>
	              <input id="password" type="password" class="form-control rounded-left" name="password" required autocomplete="current-password">
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">{{ __('Remember me') }}
									  <input id="remember_me" name="remember" type="checkbox">
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
                  @if (Route::has('password.request'))
									<a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                  @endif
								</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">{{ __('Log in') }}</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('log-in')}}/js/jquery.min.js"></script>
  <script src="{{asset('log-in')}}/js/popper.js"></script>
  <script src="{{asset('log-in')}}/js/bootstrap.min.js"></script>
  <script src="{{asset('log-in')}}/js/main.js"></script>
  </body>
</html>
