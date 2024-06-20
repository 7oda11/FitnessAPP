@extends('layouts.admin.nav')
@section('title')
    <title>Exercise Settings
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

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            width: 100%;
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
        <h2>Add New Exercise</h2>
        <form method="POST" action="{{ route('administrator.exercisestore') }}">
            @csrf
            <label for="exerciseName">Exercise Name:</label>
            <input type="text" id="exerciseName" name="exerciseName" required>
            <label for="exerciseDescription">Exercise Description:</label>
            <input type="text" id="exerciseDescription" name="exerciseDescription" required>
            <button type="submit">Add Exercise</button>
        </form>

    </main>
    <!-- Display Error Messages -->
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
