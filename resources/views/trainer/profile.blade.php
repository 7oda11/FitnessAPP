@extends('layouts.trainer.nav')
@section('title')
    <title>Trainer Profile</title>
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
        <h2>Your Profile</h2>
        <p><strong>Name:</strong> {{ auth()->guard('trainer')->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->guard('trainer')->user()->email }}</p>
        <p><strong>Age:</strong> {{ auth()->guard('trainer')->user()->age }}</p>
        <p><strong>Height</strong> {{ auth()->guard('trainer')->user()->height }}</p>
        <p><strong>Weight:</strong> {{ auth()->guard('trainer')->user()->weight }}</p>
        <p><strong>Role:</strong>Trainer</p>
        <a href="{{ route('trainer.showProfile') }}" class="edit-button">Edit Profile</a>
    </main>
@endsection
