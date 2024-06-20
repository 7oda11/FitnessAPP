@extends('layouts.User.nav')
@section('title')
    <title>Show Registered Trainer</title>
@endsection
@section('css')
    <style>
        main {
            margin: 20px;
            padding: 20px;
            width: 80%;
            max-width: 800px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .edit-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
@section('content')
    <main>
        <h2>Show Trainer</h2>
        <p><strong>Name:</strong> {{ $trainer->name }}</p>
        <p><strong>Email:</strong> {{ $trainer->email }}</p>
        <p><strong>Age:</strong> {{ $trainer->age }}</p>
        <p><strong>Phone:</strong> {{ $trainer->phone }}</p>
        <p><strong>Height</strong> {{ $trainer->height }}</p>
        <p><strong>Weight:</strong> {{ $trainer->weight }}</p>
        <p><strong>Role:</strong>Trainer</p>
        <p><strong>Number of User:</strong>{{ $num }}</p>

        <a href="{{ route('user.unregistertriner', ['id' => $trainer->id]) }}" class="edit-button">Un Register</a>
    </main>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
