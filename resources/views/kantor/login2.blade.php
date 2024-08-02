<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login {
            display: flex;
            height: 80vh; 
            align-items: flex-start; 
            justify-content: center;
            padding-top: 20px; 
        }
        .login-left {
            width: 50%;
            display: flex;
            align-items: flex-start; 
            justify-content: center;
        }
        .login-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-top: 20px; 
        }
        .login h1, .login p {
            text-align: center;
        }
        .login .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

@include('partials.header')

<section class="login">
  <div class="login-left">
    <div class="login-box">
      <div class="header">
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <h1>Selamat Datang</h1> <br>
      </div>
      <div class="login-form">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form method="post" action="">
          @csrf
          <label for="username" class="form-label">Username</label>
          <input type="username" class="form-control" value="{{ old('username') }}" id="username" name="username" placeholder="Masukkan Username" required> 

          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required> 

         <center><button type="submit" class="btn btn-signup-custom">Masuk</button></center>
        </form>
        <center><h6>Atau</h6></center>
        <center><a href="{{ route('signup') }}"><button class="btn btn-signup-custom">Daftar</button></a></center>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
