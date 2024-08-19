@include('partials.header')

<div class="container-md mt-3">
  <div class="card shadow p-3 mx-auto border-0" style="width: 450px;">
    <div class="card-body">
        <div class="header text-center">
            <h1>Daftar</h1>
          </div>        
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
              @endforeach
          </ul>
        </div>
        @endif
        <br>
      <form method="post" action="{{route('signup-proses')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="basic-default-fullname" placeholder="Nama Lengkap"  />
        </div>
        <div class="mb-3">
            <label class="form-label" for="basic-default-username">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" id="basic-default-username" placeholder="Username"  />
        </div>
        <div class="mb-3">  
            <label class="form-label" for="basic-default-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="text" name="email" id="basic-default-email" class="form-control" value="{{ old('email') }}" placeholder="Email" aria-label="Email" aria-describedby="basic-default-email2"  />
                <span class="input-group-text" id="basic-default-email2">@example.com</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" name="password" id="mypassword" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password" />
            <div id="passwordHelpBlock" class="form-text">
                Password terdiri dari 5 Karakter
            </div>
            <input type="checkbox" onclick="showHidePassword()"> Tampilkan Password
        </div>
        <input type="hidden" name="level" id="level" value="admin">
        <div class="text-center">
            <button type="submit" onclick="return confirm('Apakah Anda Yakin Untuk Menyimpan Akun ?');" class="btn btn-signup-custom">Daftar</button>
        </div>
      </form>
        <a href="{{ route('login2') }}"><button class="btn btn-signup-custom">< Kembali</button></a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
  function showHidePassword() {
    var inputan = document.getElementById("mypassword");
    if (inputan.type === "password") {
      inputan.type = "text";
    } else {
      inputan.type = "password";
    }
  }
</script>