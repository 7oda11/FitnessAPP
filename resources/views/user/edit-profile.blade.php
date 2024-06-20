@extends('layouts.User.nav')
@section('title')
    <title>Update user profile</title>
@endsection
@section('css')
    <style>
        h1 {
            color: red;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .buttons {
            margin-bottom: 20px;
        }

        button {
            width: 150px;
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
        }

        input,
        select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #trainer-form {
            background-color: #e7f0fe;
        }

        #trainee-form {
            background-color: #ffe7e0;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <form id="trainer-form" method="POST" action="{{ route('user.update') }}">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name',  auth()->user()->name ) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}"
                required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="text" name="username" placeholder="Username"
                value="{{ old('username', auth()->user()->username) }}" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password">

            <select name="gender" required>
                <option value="" disabled selected>Gender</option>
                <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female
                </option>
                <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other
                </option>
            </select>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="number" name="age" placeholder="Age" value="{{ old('age', auth()->user()->age) }}" required>
            @error('age')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="text" name="location" placeholder="Location"
                value="{{ old('location', auth()->user()->location) }}" required>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="tel" name="phone" placeholder="Phone Number"
                value="{{ old('phone', auth()->user()->phone) }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="number" name="weight" placeholder="Weight (kg)"
                value="{{ old('weight', auth()->user()->weight) }}" required>
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="number" name="height" placeholder="Height (cm)"
                value="{{ old('height', auth()->user()->height) }}" required>
            @error('height')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit">update</button>
        </form>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
@endsection
