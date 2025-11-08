@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<h2>Create User</h2>

@include('alert.alert')

<form action="{{ route('admin.store') }}" method="POST">
    @csrf

    {{-- Name --}}
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    @error('name')
        <div style="color:red; font-size:14px;">{{ $message }}</div>
    @enderror
    <br><br>

    {{-- Email --}}
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email')
        <div style="color:red; font-size:14px;">{{ $message }}</div>
    @enderror
    <br><br>

    {{-- Password --}}
    <label>Password:</label>
    <input type="password" name="password" required>
    @error('password')
        <div style="color:red; font-size:14px;">{{ $message }}</div>
    @enderror
    <br><br>

    {{-- Role for Admin user --}}
    @if (auth()->user()->role === 'Admin')
        <label>Role:</label>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>Member</option>
        </select>
        @error('role')
            <div style="color:red; font-size:14px;">{{ $message }}</div>
        @enderror
        <br><br>
    @endif

    {{-- Company selection --}}
    @if (auth()->user()->role === 'SuperAdmin')
        <label>Company:</label>
        <select name="company_id" required>
            <option value="">Select Company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" 
                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->company_name }}
                </option>
            @endforeach
        </select>
        @error('company_id')
            <div style="color:red; font-size:14px;">{{ $message }}</div>
        @enderror
    @else
        <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
        <p><strong>Company:</strong> {{ auth()->user()->company->company_name }}</p>
    @endif

    <br><br>

    <button type="submit">Create</button>
</form>

@endsection
