@extends('layouts/index')

@section('content')
    <div>
        Welcome to registration page
    </div>
    <form style="width: 200px;"  method="post" action="{{url('auth/registration')}}">
        @csrf
        <input type="text" name="name"/>
        <input type="email" name="email"/>
        <input type="password" name="password"/>
        <button type="submit">Submit</button>
    </form>
@endsection
