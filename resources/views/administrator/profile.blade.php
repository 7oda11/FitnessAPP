@extends('layouts.admin.nav')
@section('title')
    <title>Admin Profile
    </title>
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
        <p><strong>Name:</strong> {{ auth()->guard('administrator')->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->guard('administrator')->user()->email }}</p>
        <p><strong>Role:</strong> administrator</p>
        <a href="edit_profile.html" class="edit-button">Edit Profile</a>
    </main>
@endsection
