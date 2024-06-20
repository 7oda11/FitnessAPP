@extends('layouts.trainer.nav')
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
        <h2>Add New Meetig</h2>
        <form method="POST" action="{{ route('trainer.createMeeting') }}">
            @csrf
            <label for="MeetinLink">Meeting Link:</label>
            <input type="text" id="MeetinLink" name="MeetinLink" required>
            <label for="MeetingTime">Meeting Time:</label>
            <input type="text" id="MeetingTime" name="MeetingTime" required>
            <label for="workout">Select User:</label>
            <select id="workout" name="user_id" required>
                <option disabled selected>Select a user</option>
                @foreach ($trainer->users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button type="submit">Add Meeting</button>
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
