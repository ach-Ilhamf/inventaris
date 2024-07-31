@include('partials.header')

<div class="container-md mt-3">
  <div class="header text-center">
    <h1>Sign Up</h1>
  </div>
  <div class="card shadow p-3 mx-auto border-0" style="width: 450px;">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
              @endforeach
          </ul>
        </div>
        @endif
      <form method="post" action="{{route('signup-proses')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="basic-default-fullname" placeholder="Nama Lengkap"  />
        </div>
        <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" id="basic-default-fullname" placeholder="Username"  />
        </div>
            
        <div class="mb-3">  
            <label class="form-label" for="basic-default-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="text" name="email" id="basic-default-email" class="form-control" value="{{ old('email') }}" placeholder="Email" aria-label="john.doe" aria-describedby="basic-default-email2"  />
                <span class="input-group-text" id="basic-default-email2">@example.com</span>
            </div>
        </div>

        <div class="mb-3">
            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" name="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password" />
            <div id="passwordHelpBlock" class="form-text">
                Password terdiri dari 5 Karakter
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="level" value="admin">
                <label class="form-check-label" for="level">Admin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="level" value="pegawai">
                <label class="form-check-label" for="level">Pegawai</label>
            </div>
            {{-- <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="distRole" value="2">
                <label class="form-check-label" for="distRole">distributor</label> --}}
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-signup-custom">Sign Up</button>
        </div>
      </form>

      <!-- Modal Bootstrap untuk Pesan Sukses -->
      <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Your registration is successful!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div><br>
    <div class="text-center">
        <a href="{{ route('login2') }}"><button class="btn btn-signup-custom">< Back</button></a>
    </div><br>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

