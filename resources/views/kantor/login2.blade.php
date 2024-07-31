@include('partials.header')

<section class="login d-flex">
  <div class="login-left w-50 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-6">
        <div class="header">
          @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <h1>Welcome Back</h1>
          <p>Welcome back! Please enter your details</p>
        </div>
        <div class="login-form">
          <!-- Form Login -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                  @endforeach
              </ul>
            </div>
          @endif
          <form method="post" action="">
            @csrf
              <label for="username" class="form-label">Username</label>
              <input type="username" class="form-control" value="{{ old('username') }}" id="username" name="username" placeholder="Enter your Username" required> 

              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required> 

              <button type="submit" type="submit" class="login mt-3">Login</button>
          </form>
          <center><h6>Or</h6></center>
          <center><a href="{{route('signup')}}"><button class="login mt-3">Sign Up</button></a></center>
        </div>
      </div>
    </div>
  </div>

  <div class="login-right w-50 h-100">   
    <div id="carouselLoginFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner">
        <!-- <div class="carousel-item active">
          <img src="img/login/1.svg" class="d-block w-100" alt="Slide 1">
        </div> -->
        <div class="carousel-item active">
          <img src="{{ asset('img/login/2.svg') }}" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('img/login/3.svg') }}" class="d-block w-100" alt="Slide 2">
        </div>
      </div>
    </div>
  </div>
</section>