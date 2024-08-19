<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Pemantauan Aset Dinas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('img/logo/landing.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .overlay {
            background-color: rgba(128, 128, 128, 0.7); 
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        .content {
            z-index: 2;
            text-align: center;
        }
        .content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .content .btn {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 3;
        }
    </style>
</head>
<body>

<header>
    @include('partials.header')
</header>

<div class="overlay"></div>

<div class="content">
    <h1 style="color: white">PEMANTAUAN ASET DINAS KOMINFO GRESIK</h1><br>
    <a href="{{ route('login2') }}" class="btn btn-primary">MASUK</a>
    <a href="{{ route('signup') }}" class="btn btn-success">DAFTAR</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
