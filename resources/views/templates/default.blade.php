<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="_token" content="{!! csrf_token() !!}" />
        <title>SocApp</title>

		{{-- Load styles --}}
		<link rel="stylesheet" href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/noty.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />

	</head>
	<body>
		@include('templates/partials/navigation')
		<div class="container">
			@include('templates/partials/alerts')
			@yield('content')
		</div>
	<script src="{{ asset('js/jquery3.2.1.js') }}"></script>
	<script src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/noty.js') }}"></script>
    <script src="{{ asset('js/setup.js') }}"></script>
	<script src="{{ asset('js/searchUsers.js') }}"></script>
	<script src="{{ asset('js/likes.js') }}"></script>
	</body>
</html>