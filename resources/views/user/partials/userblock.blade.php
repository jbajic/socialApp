<div class="media">
	<a class="pull-left" href="{{ route('profile', $user->id) }}">
		<img class="media-subject" src="{{ $user->getAvatarUrl() }}" alt="avatar">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ route('profile', $user->id) }}">{{ $user->getNameOrUsername() }}</a></h4>
		@if( $user->location )
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>