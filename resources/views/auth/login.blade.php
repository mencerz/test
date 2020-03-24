@extends('layouts/index')

@section('content')
    <div>
        Welcome to login page
    </div>
    <form style="width: 200px;"  method="post" action="{{url('auth/login')}}">
        @csrf
        <input type="email" name="email"/>
        <input type="password" name="password"/>
        <button type="submit">Login</button>
    </form>
@endsection
