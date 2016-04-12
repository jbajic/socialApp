@extends('templates/default')
@section('content')
		<div class="row">
		 <div class="col-lg-6">
			{!! Form::model($user, ['method' => 'post', 'route' => 'profile.updateProfile']) !!}

				<div class="form-group{{ $errors->has('first_name') ? ' has-error': '' }}">
					{!! Form::label('first_name', 'First name:') !!}
					{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
					@if( $errors->has('first_name') )
						<span class="help-block">{{ $errors->first('first_name') }}</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('last_name') ? ' has-error': '' }}">
					{!! Form::label('last_name', 'Last name:') !!}
					{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
					@if( $errors->has('last_name') )
						<span class="help-block">{{ $errors->first('last_name') }}</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('location') ? ' has-error': '' }}">
					{!! Form::label('location', 'Location:') !!}
					{!! Form::text('location', null, ['class' => 'form-control']) !!}
					@if( $errors->has('location') )
						<span class="help-block">{{ $errors->first('location') }}</span>
					@endif
				</div>

				<button class="btn btn-default" type="submit">Update</button>
		{!! Form::close() !!}
        </div>
	</div>
<!-- 
value="{{ Request::old('first_name') ?: Auth::user()->first_name }}"
-->
@endsection