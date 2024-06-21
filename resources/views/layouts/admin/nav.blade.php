<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        header h1 {
            margin: 0;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #444;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #555;
        }
    </style>
    @yield('css')
</head>

<body>
    <header>
        <h1>Admin Workouts</h1>
        <nav>
            <a href="{{ route('administrator.dashboard') }}">Home</a>
            <a href="{{ route('administrator.profile') }}">Profile</a>
            <a href="{{ route('administrator.workouts') }}">workout</a>
            <a href="{{ route('administrator.meeting') }}">Meetings</a>
            {{-- <a href="{{ route('administrator.exercise') }}">Exercise Settings</a> --}}
            <a href="{{ route('administrator.logoutShow') }}">Logout</a>
        </nav>
    </header>
    @yield('content')
    @yield('js')
</body>

</html>
