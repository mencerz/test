<ul>
    <li><a href="{{ url('/') }}">Home</a></li>
    @guest
        <li><a href="{{ url('auth/login') }}">Login</a></li>
        <li><a href="{{ url('auth/create') }}">Registration</a></li>
    @endguest

    @auth
        @if(Auth::user()->isRoleManager())
            <li><a href="{{ url('client-request') }}">Requests list</a></li>
        @endif
        @if(Auth::user()->isRoleClient())
            <li><a href="{{ url('client-request/create') }}">Create request</a></li>
        @endif
        <li><a href="{{ url('auth/logout') }}">Logout</a></li>
    @endauth

</ul>
