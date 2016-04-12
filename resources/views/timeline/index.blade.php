@extends('templates/default')
@section('content')
<!-- 
Approach 1 (offsets):
The first approach uses Bootstrap's own offset classes so it requires no change in markup and no extra CSS. The key is to set an offset equal to half of the remaining size of the row. So for example, a column of size 2 would be centered by adding an offset of 5, that's (12-2)/2.

In markup this would look like:

<div class="row">
    <div class="col-md-2 col-md-offset-5"></div>
</div>
-->
	<div class="row">
		<div class="col-lg-6 col-md-offset-3">
			{!! Form::open(['method' => 'post', 'route' => 'status.post']) !!}

				<div class="form-group{{ $errors->has('status') ? ' has-error':'' }}">
					{!! Form::textarea('status', null, array('placeholder' => 'What\'s on your mind?', 'rows' => '3', 'class' => 'form-control')) !!}
					@if( $errors->has('status') )
						<span class="help-block">
							{{ $errors->first('status') }}
						</span>
					@endif
				</div>
				<button type="submit" class="btn btn-default">Post</button>

			{!! Form::close() !!}
		<hr /> 
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 col-md-offset-3">
			@if( !$statuses->count() )
				<p>There is nothing in your timeline yet.</p>
			@else
				@foreach( $statuses as $status )
					<div class="media">
					    <a class="pull-left" href="{{ route('profile', $status->user->id) }}">
					        <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
					    </a>
					    <div class="media-body">
					        <h4 class="media-heading"><a href="{{ route('profile', $status->user->id) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
					        <p>{{ $status->body }}</p>
					        <ul class="list-inline">
					            <li>{{ $status->created_at->diffForHumans() }}</li>
					            @if( $status->user->id !== Auth::user()->id )
						            <li><a href="{{ route('status.like', $status->id) }}">Like</a></li>
						        @endif
						        <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>						        
					        </ul>
					 
					 		@foreach( $status->replies as $reply )
						       	<div class="media">
						            <a class="pull-left" href="{{ route('profile', $reply->user_id) }}">
						                <img class="media-object" alt="avatar" src="{{ $reply->user->getAvatarUrl() }}">
						            </a>
						            <div class="media-body">
						                <h5 class="media-heading"><a href="{{ route('profile', $reply->user_id) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
						                <p>{{ $reply->body }}</p>
						                <ul class="list-inline">
						                    <li>{{ $reply->created_at->diffForHumans() }}</li>
						                    @if( $reply->user->id !== Auth::user()->id )
							                    <li><a href="{{ route('status.like', $reply->id) }}">Like</a></li>
							             	@endif
							                <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
						                </ul>
						            </div>
						        </div>
					 		@endforeach
					        <form role="form" action="{{ route('status.reply.post', array( 'id' => $status->id)) }}" method="post">
					            <div class="form-group{{ $errors->has('reply-' . $status->id) ? ' has-error':'' }}">
					                <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
					                @if( $errors->has('reply-' . $status->id) )
					                	<span class="help-block">
											{{ $errors->first('reply-' . $status->id) }}
										</span>
					                @endif
					            </div>
					            <input type="submit" value="Reply" class="btn btn-default btn-sm">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
					            <!--  <input type="hidden" name="_token" value="{{ Session::token() }}"> -->
					        </form>
					    </div>
					</div>
				@endforeach
				{!! $statuses->render() !!}
			@endif
		</div>
	</div>
@endsection