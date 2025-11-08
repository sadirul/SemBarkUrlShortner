@extends('layouts.app')

@section('title', 'Create Short URL')

@section('content')

    <h2>Create Short URL</h2>

    <form action="{{ route('url.store') }}" method="POST">
        @csrf

        <label>Long URL:</label>
        <input type="url" name="long_url" required>

        <br><br>

        <button type="submit">Generate</button>
    </form>

@endsection
