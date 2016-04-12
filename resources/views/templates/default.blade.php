<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- aIn addition to checking for the CSRF token as a POST parameter, the Laravel VerifyCsrfToken middleware
		 will also check for the X-CSRF-TOKEN request header. You could, for example, store the token in a "meta" tag:

		<meta name="csrf-token" content="{{ csrf_token() }}">
		Once you have created the meta tag, you can instruct a library like jQuery to add the token to all request headers.
		 This provides simple, convenient CSRF protection for your AJAX based applications:

		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		});  -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>SocApp</title>

		{{-- Load styles --}}
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}" />

	</head>
	<body>
		@include('templates/partials/navigation')
		<div class="container">
			@include('templates/partials/alerts')
			@yield('content')
		</div>
	</body>
</html>