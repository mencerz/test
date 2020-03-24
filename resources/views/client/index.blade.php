@extends('layouts/index')

@section('content')
    <div>
        Welcome to client request page
    </div>
    <form style="width: 200px;" enctype="multipart/form-data" method="post" action="{{url('client-request')}}">
        @csrf
        <input placeholder="subject" type="text" name="subject"/>
        <textarea rows="10" cols="25" placeholder="message" name="message"></textarea>
        <input type="file" name="file"/>
        <button type="submit">Submit</button>
    </form>
@endsection
