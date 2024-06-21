@extends('layouts.admin.nav')
@section('title')
    <title>Admin Workouts
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
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
    </style>
@endsection
@section('content')
    <main>
        <h2>Manage Workouts</h2>
        <ul id="workouts-list">
            @foreach ($exercise as $data)
                <h4>User Name : {{ $data->user->name }}</h1>
                    <h4>Trainer Name : {{ $data->trainer->name }}</h1>
                        <li>Content Name : {{ $data->name }}</li>
                        <li>Content Description :  {{ $data->description }}</li>
                        <hr>
            @endforeach
        </ul>
    </main>
@endsection
