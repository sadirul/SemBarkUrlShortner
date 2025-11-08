@extends('layouts.app')

@section('title', 'Company')

@section('content')

    <a href="{{ route('company.create') }}">Add New Company</a>

    <h2>Company List</h2>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Total Users</th>
            <th>Total URLs</th>
            <th>Total Hits</th>
            <th>Action</th>
        </tr>

        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->users_count }}</td>
                <td>{{ $company->urls_count }}</td>
                <td>{{ $company->hits_sum ?? 0 }}</td>
                <td><a href="{{ route('dashboard.index', ['company_id' => $company->id]) }}">View URL</a></td>
            </tr>
        @endforeach
    </table>


@endsection
