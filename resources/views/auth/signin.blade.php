@extends('templates/default')
@section('content')
<h3>Sign in</h3>
<div class="row">
	<div class="col-sm-4">
		{!! Form::open(['method' => 'post', 'route' => 'auth.signin.post']) !!}

			<div class="form-group{{ $errors->has('email') ? ' has-error': '' }}">
				{!! Form::label('email', 'Email:') !!}
				{!! Form::email('email', null, ['class' => 'form-control']) !!}
				@if( $errors->has('email') )
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error': '' }}">
				{!! Form::label('password', 'Password:') !!}
				{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
				@if( $errors->has('password') )
					<span class="help-block">{{ $errors->first('password') }}</span>
				@endif
			</div>

			<div class="form-group">
				{!! Form::label('remember_me', 'Remember me:') !!}
				{!! Form::checkbox('remember_me') !!}
				<span class="help-block"></span>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Sign in</button>
			</div>

		{!! Form::close() !!}
	</div>
</div>
@endsection