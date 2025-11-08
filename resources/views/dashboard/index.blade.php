@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('alert.alert')
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Short URL</th>
            <th>Long URL</th>
            <th>Hits</th>
            @if (in_array(auth()->user()->role, ['Admin']))
                <th>Created By</th>
            @endif
            @if (in_array(auth()->user()->role, ['SuperAdmin']))
                <th>Copamny</th>
            @endif
            <th>Created On</th>
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
                @if (in_array(auth()->user()->role, ['Admin']))
                    <td>
                        {{ $url->creator->id == Auth::id() ? 'You' : $url->creator->name }}
                    </td>
                @endif
                @if (in_array(auth()->user()->role, ['SuperAdmin']))
                    <td>
                        {{ $url->company->company_name }}
                    </td>
                @endif
                <td>{{ $url->created_at->format('d M Y') }}</td>

            </tr>
        @endforeach
    </table>
@endsection
