<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a href="#" class="navbar-brand">SocialApp</a>
                </div>
               
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        @if (Auth::check())
                                <ul class="nav navbar-nav">
                                        <li><a href="{{ route('home') }}">Timeline</a></li>
                                        <li><a href="{{ route('friend.index') }}">Friends</a></li>
                                </ul>
                               
                                <form action="{{ route('search.results') }}" role="search" class="navbar-form navbar-left">
                                        <div class="form-group">
                                                <input type="text" id="userSearch" name="search_string" class="form-control"
                                                placeholder="Find people" />
                                        </div>
                                        <button type="submit" class="btn btn-default">Search</button>
                                </form>
                        @endif
                        <ul class="nav navbar-nav navbar-right">
                                @if(Auth::check())
                                        <li>
                                            <a href="{{ route('profile', Auth::user()->id) }}">
                                                <img src="{{ Auth::user()->getAvatarUrl()  }}" class="avatar-icon avatar-icon-s" />
                                                {{ Auth::user()->getNameOrUserName() }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.editProfile') }}">
                                                <i class="fa fa-edit"></i>Update profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.signout') }}">
                                                <i class="fa fa-sign-out"></i>Sign out
                                            </a>
                                        </li>
                                @else
                                        <li>
                                            <a href="{{ route('auth.signup') }}">
                                                <i class="fa fa-user-plus"></i> Sign up
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.signin') }}">
                                                <i class="fa fa-sign-in"></i> Sign in
                                            </a>
                                        </li>
                                @endif
                        </ul>
                </div>
        </div>
</nav>