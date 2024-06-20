@extends('layouts.User.nav')
@section('title')
    <title>user Meetings</title>
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

        .button-container {
            text-align: center;
            margin-top: 20px;
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
            @if ($meetings->isNotEmpty())
                @foreach ($meetings as $meet)
                    <li>{{ $meet->trainer->name }} : <a href="{{ route('user.showMeeting', ['id' => $meet->id]) }}">{{ $meet->meeting_link }} -
                            time=> {{ $meet->meeting_time }}</a></li>
                @endforeach

        </ul>
    @else
        <h3 class="alert">You do not have any meetings</h1>
            @endif
            {{-- <div class="button-container">
                <button onclick="location.href='{{ route('user.scheduled') }}'">Schedule Meeting</button>
            </div> --}}
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
