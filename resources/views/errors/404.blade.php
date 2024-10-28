<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #343a40;
        }
        .container {
            text-align: center;
        }
        .container img {
            max-width: 100%;
            height: auto;
        }
        .container h1 {
            margin: 20px 0;
            font-size: 2em;
        }
        .container p {
            font-size: 1.2em;
        }
        .container a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('uploads/error1.jpg') }}" alt="404 Not Found">
        <h1>Oops! Page Not Found</h1>
        <p>Silakan logout terlebih dahulu</p>
        <a href="{{ url('/') }}">Logout</a>
    </div>
</body>
</html>