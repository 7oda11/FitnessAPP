@extends('layouts.trainer.nav')
@section('title')
    <title>show Exercise</title>
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

        .delete-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            background-color: red;
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
        <h2>Your Exercises</h2>
        @foreach ($workout as $data)
            <p><strong>Trainer Name:</strong> {{ auth()->guard('trainer')->user()->name }}</p>
            <p><strong>User Name:</strong> {{ $data->user->name }}</p>
            <p><strong>Exercise Name:</strong> {{ $data->name }}</p>
            <p><strong>Exercise Description</strong> {{ $data->description }}</p>
            <a href="{{ route('trainer.showEditExercises', ['id' => $data->id]) }}" class="edit-button">Edit Exercise</a>
            <a href="{{ route('trainer.deleteExercises', ['id' => $data->id])  }}" class="delete-button">Delete Exercise</a>
            <hr>
        @endforeach
    </main>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display Success Message -->
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
@endsection
