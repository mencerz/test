@extends('layouts/index')

@section('content')
    <div>
        Welcome to logout page
    </div>
    <form method="post" action="{{url('auth/logout')}}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
