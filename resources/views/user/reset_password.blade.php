<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title }}</title>

   {{-- Icon --}}
   <link rel="icon" type="image/gif/png" href="/img/smanel-logo.png">

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

<body>
   @if (session()->has('loginError'))
      <div class="failAlert" hidden>{{ session('loginError') }}</div>
   @endif
   <div class="hold-transition login-page"
      style="background-image: url('{{ asset('/img/background-login.jpg') }}'); background-size: cover; background-attachment: fixed;">
      <div class="mb-4">
         <img src="/img/smanel-logo.png" alt="" class="" style="height: 130px; width: 115px">
      </div>
      <div class="login-box mb-5">
         <div class="card card-outline card-warning">
            <div class="card-header text-center">
               <span class="h1">SIM-<b>SMANEL</b></span><br>
               <span class=""><small>Sistem Informasi Manajemen SMA Negeri 5
                     Merangin</small></span>
            </div>
            <div class="card-body">
               <p class="login-box-msg">
                  Buat kata sandi baru
               </p>
               <form action="/reset-password" method="post">
                  @csrf
                  <!-- Password Reset Token -->
                  <input type="hidden" name="token" value="{{ $request->route('token') }}">

                  <div class="input-group mb-3">
                     <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        value="{{ old('email', $request->email) }}" readonly>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi baru"
                        autofocus required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Konfirmasi kata sandi baru" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     @error('password_confirmation')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Ubah kata sandi</button>
                     </div>

                  </div>
               </form>
               <p class="ml-1 mt-3 mb-1">
                  <a href="/login">Login</a>
               </p>
            </div>
         </div>
      </div>
      <!-- /.login-box -->
   </div>

   <!-- jQuery -->
   <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   {{-- Page spesific script --}}
   <script>
      $(function() {
         if ($('.successAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-success mt-1 mr-1',
               title: 'Berhasil',
               autohide: true,
               delay: 5000,
               body: $('.successAlert').text()
            });
         }

         if ($('.failAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-danger mt-1 mr-1',
               title: 'Gagal',
               autohide: true,
               delay: 5000,
               body: $('.failAlert').text()
            });
         }
      });
   </script>
</body>

</html>
