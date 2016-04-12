@extends('templates/default')
@section('content')
	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr />

			@if( !$statuses->count() )
				<p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything.</p>
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
					 		@if( $authUserIsFriend || Auth::user()->id === $user->id )
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
					       @endif
					    </div>
					</div>
				@endforeach
			@endif

		</div>

		<div class="col-lg-4 col-lg-offset-3">
			@if( $hasFriendRequestPending )

				<p>Waiting for {{ $user->name }} to accept your request.</p>

			@elseif( Auth::user()->hasFriendRequestReceveid($user) )

				<a href="{{ route('friends.accept', $user->id) }}" class="btn btn-primary">Accept</a>

			@elseif( $isFriend )

				<p>You and {{ $user->name }} are friends!</p>
				<form action="{{ route('friends.delete', $user->id) }}" method="post">
					<button class="btn btn-danger" type="submit">Delete</button>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>

			@elseif( Auth::user()->id !== $user->id )

				<a href="{{ route('friends.add', array('id' => $user->id)) }}" class="btn btn-primary">Add as friend</a>

			@endif
			<h4>{{ $user->name }}'s friends</h4>

			@if( !$friends->count() )
				<p>{{ $user->name }} has no friends!</p>
			@else
				@foreach( $friends as $user )
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>
@endsection