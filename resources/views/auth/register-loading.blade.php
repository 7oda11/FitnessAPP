<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            background-color: #000080;
        }
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
            width: 200px;
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
            display: none;
        }
        input, select {
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
</head>
<body>
    <h1>Sign Up</h1>
    <div class="container">
        <div class="buttons">
            <button onclick="location.href='{{ route('trainer.register') }}'">Sign Up as Trainer</button>
            <button onclick="location.href='/register'">Sign Up as User</button>
        </div>
    </div>
</body>
</html>
