@extends('layouts/index')

@section('content')
    <div>
        Welcome to manager page
    </div>
    <table id="requests-table" border="1" width="100%" cellpadding="5">
        <tr>
            <th>subject</th>
            <th>message</th>
            <th>name</th>
            <th>email</th>
            <th>is_viewed</th>
            <th>file_link</th>
        </tr>
        <tr>
            @foreach($clientRequests as $clientRequest )
                <td>{{$clientRequest->subject}}</td>
                <td>{{$clientRequest->message}}</td>
                <td>{{$clientRequest->user->name}}</td>
                <td>{{$clientRequest->user->email}}</td>
                <td>
                    <input class="js-viewed" type="checkbox" name="is_viewed" value="{{$clientRequest->id}}"
                        {{ $clientRequest->is_viewed ? 'checked="checked" ' : '' }}
                    >
                </td>
                <td><a href="{{ url('client-request/download-file/'. $clientRequest->id) }}">download file</a></td>
            @endforeach
        </tr>
    </table>
    <script>

        // only for test style
        window.addEventListener('load', function () {
            const viewed = document.querySelectorAll('.js-viewed');

            async function toggleViewed(event) {
                await fetch('/client-request/' + event.target.value, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        '_method': 'put',
                    })
                });
            }

            viewed.forEach(function (next) {
                next.addEventListener('change', toggleViewed);
            });
        });
    </script>
@endsection
