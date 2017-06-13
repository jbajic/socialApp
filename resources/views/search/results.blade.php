@extends('templates/default')
@section('content')
	<h3>Your search for "{{ Request::input('search_string') }}"</h3>
	@if( !$users->count() )
		<p>No results found!</p>
	@else
		<div class="row">
			<div class="col-lg-12">
				@foreach( $users as $user )
					@include('user.partials.userblock')
				@endforeach
			</div>
		</div>
	@endif
@endsection