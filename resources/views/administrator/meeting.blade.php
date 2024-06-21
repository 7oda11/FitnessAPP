@extends('layouts.admin.nav')
@section('title')
    <title>Admin Meetings
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
        <h2>Upcoming Meetings</h2>
        <ul>
            @foreach ($meeting as $data)
                <h4>User Name : {{ $data->user->name }}</h1>
                    <h4>Trainer Name : {{ $data->trainer->name }}</h1>
                        <li>Time : {{ $data->meeting_time }} </li>
                        <li>Link :  {{ $data->meeting_link }}</li>
                        <hr>
            @endforeach
        </ul>
    </main>
@endsection
