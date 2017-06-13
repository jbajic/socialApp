@extends('templates/default')
@section('content')
<h3>Register</h3>
<div class="row">
	<div class="col-sm-4">
		{!! Form::open(['method' => 'post', 'route' => 'auth.signup.post']) !!}

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				{!! Form::label('email', 'Email:') !!}
				{!! Form::email('email', Request::old('email') ?: '', ['class' => 'form-control']) !!}
				@if( $errors->has('email') )
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				{!! Form::label('username', 'Username:') !!}
				{!! Form::text('username', Request::old('username') ?: '', ['class' => 'form-control']) !!}
				<span class="help-block">{{ $errors->first('username') }}</span>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				{!! Form::label('password', 'Password:') !!}
				{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
				<span class="help-block">{{ $errors->first('password') }}</span>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Register</button>
			</div>

		{!! Form::close() !!}
	</div>
</div>
@endsection