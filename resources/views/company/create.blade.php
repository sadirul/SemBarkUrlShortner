@extends('layouts.app')

@section('title', 'Add Company')

@section('content')

    <h2>Add Company</h2>
    @include('alert.alert')
    <form action="{{ route('company.store') }}" method="POST">
        @csrf
        <label>Company Name:</label>
        <input type="text" name="company_name" required>
        <button type="submit">Save</button>
        <br>
        @error('company_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </form>

@endsection
