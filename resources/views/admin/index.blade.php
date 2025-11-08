@extends('layouts.app')

@section('title', 'Admin List')

@section('content')

    <a href="{{ route('admin.create') }}">Add User</a>

    <h2>Admin List</h2>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Company</th>
        </tr>

        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->role }}</td>
                <td>{{ $admin->company->company_name ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

@endsection
