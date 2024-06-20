<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Welcome to the Fitness App</h1>
    <div class="buttons">
        <button onclick="location.href='{{ route('registerLoading') }}'">Sign Up</button>
        <button onclick="location.href='{{ route('loginLoading') }}'">Log In</button>
    </div>
</body>

</html>
