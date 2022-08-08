@extends('layouts.main')

@section('head')
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>{{ $title }}</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item">Data Pengguna</li>
                     <li class="breadcrumb-item active">Edit Data Pengguna</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="card card-primary">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <h4 class="m-0">Data {{ $pengguna->username }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/pengguna/{{ $pengguna->id }}">
                        @method('put')
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control @error('username') is-invalid @enderror"
                                 id="username" name="username" placeholder="Masukkan username"
                                 value="{{ old('username', $pengguna->username) }}" required autofocus>
                              @error('username')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="role">Role</label>
                              <select class="form-control @error('role') is-invalid @enderror" name="role"
                                 id="role" required>
                                 <option selected disabled hidden value="">-- Pilih role pengguna --</option>
                                 @if (old('role', $pengguna->role) == '2')
                                    <option value="2" selected>Guru</option>
                                    <option value="3">Tata Usaha</option>
                                    @if (!$kepsek)
                                       <option value="4">Kepala Sekolah</option>
                                    @endif
                                 @elseif (old('role', $pengguna->role) == '3')
                                    <option value="2">Guru</option>
                                    <option value="3" selected>Tata Usaha</option>
                                    @if (!$kepsek)
                                       <option value="4">Kepala Sekolah</option>
                                    @endif
                                 @elseif (old('role', $pengguna->role) == '4')
                                    <option value="2">Guru</option>
                                    <option value="3">Tata Usaha</option>
                                    <option value="4" selected>Kepala Sekolah</option>
                                 @else
                                    <option value="2">Guru</option>
                                    <option value="3">Tata Usaha</option>
                                    @if (!$kepsek)
                                       <option value="4">Kepala Sekolah</option>
                                    @endif
                                 @endif
                              </select>
                              @error('role')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="pegawai_id">Pegawai</label>
                              <select class="form-control @error('pegawai_id') is-invalid @enderror" name="pegawai_id"
                                 id="pegawai" required>
                                 <option selected disabled hidden value="">-- Pilih pegawai --</option>
                                 @foreach ($pegawai as $p)
                                    @if (old('pegawai_id', $pengguna->pegawai_id) == $p->id)
                                       <option value="{{ $p->id }}" selected>{{ $p->nama }}</option>
                                    @else
                                       <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endif
                                 @endforeach
                              </select>
                              @error('pegawai_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group row mt-4 mb-3">
                              <label for="option_reset_password" class="col-form-label pr-0 mx-2 mr-3">Reset
                                 Password?</label>
                              <div class="col-2 pl-0 mr-3">
                                 <select class="form-control" name="option_reset_password" id="option_reset_password"
                                    onchange="cekResetPassword()" required>
                                    <option value="no" selected>Tidak</option>
                                    <option value="yes">Ya</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group" id="reset_password_form" hidden>
                              <label for="password">Password Baru</label>
                              <input type="password" class="form-control @error('password') is-invalid @enderror"
                                 id="password" name="password" placeholder="Masukkan password baru">
                              @error('password')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                           <a href="{{ URL::previous() }}" class="btn btn-secondary">Batal</a>
                        </div>
                     </form>
                  </div>
                  <!-- /.card -->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
@endsection

@section('script')
   <!-- jQuery -->
   <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- bs-custom-file-input -->
   <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         $('#role').on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('pengguna-get-pegawai') }}",
               method: "post",
               data: {
                  role_id: $("#role").val()
               },
               beforeSend: function() {
                  $("#pegawai").text('');
               },
               success: function(result) {
                  $("#pegawai").append(result);
               }
            });
         });
      });

      $(function() {
         bsCustomFileInput.init();
      });

      function cekResetPassword() {
         let optionReset = document.querySelector("#option_reset_password").value;
         let passwordForm = document.querySelector("#reset_password_form");
         let input = document.querySelector("#password");

         if (optionReset == 'yes') {
            passwordForm.removeAttribute("hidden");
            input.setAttribute("required", true);
         } else {
            input.removeAttribute("required");
            passwordForm.setAttribute("hidden", true);
         }
      }
   </script>
@endsection
