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
         <!-- /.login-logo -->
         <div class="card card-outline card-warning">
            <div class="card-header text-center">
               <a href="/adminlte/index2.html" class="h1">My<b>SMANEL</b></a>
            </div>
            <div class="card-body">
               <p class="login-box-msg">Silahkan login terlebih dahulu</p>

               <form action="/login" method="post">
                  @csrf
                  <div class="input-group mb-3">
                     <input type="text" id="username" name="username"
                        class="form-control @error('username') is-invalid @enderror" placeholder=" Username" required
                        autofocus value="{{ old('username') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     @error('username')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder=" Password" required>
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
                  <div class="row">
                     <div class="col-5 align-content-center ml-auto">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
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
         if ($('.warningAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-warning',
               title: 'Toast Title',
               autohide: true,
               delay: 5000,
               subtitle: 'Subtitle',
               body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            });
         }
         if ($('.failAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-danger',
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
