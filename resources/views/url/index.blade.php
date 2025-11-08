@extends('layouts.app')

@section('title', 'Short URLs')

@section('content')

    <h2>All Short URLs</h2>

    @include('alert.alert')

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Short URL</th>
            <th>Long URL</th>
            <th>Hits</th>
        </tr>

        @foreach ($urls as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td>
                    <a href="{{ url('/s/' . $url->short_url) }}" target="_blank">
                        {{ url('/s/' . $url->short_url) }}
                    </a>
                </td>
                <td>{{ $url->long_url }}</td>
                <td>{{ $url->hits }}</td>
            </tr>
        @endforeach
    </table>

@endsection
