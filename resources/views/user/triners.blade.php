@extends('layouts.User.nav')
@section('title')
    <title>Trainers</title>
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
        <h2>Available Trainers</h2>
        <ul id="workouts-list">
            @foreach ($availableTrainers as $data)
                <li><a href="{{ route('user.showtriner',['id'=>$data->id]) }}">{{ $data->name }} : {{ $data->email }}</a></li>
            @endforeach
        </ul>
    </main>
     @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
@endsection
