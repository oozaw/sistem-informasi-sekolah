@extends('layouts.main')

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
                     <li class="breadcrumb-item active">Tambah Data Pengguna</li>
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
                  <div class="card card-success">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <h4 class="m-0">Data Pengguna Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/pengguna">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                 name="username" placeholder="Masukkan username" value="{{ old('username') }}" required
                                 autofocus>
                              @error('username')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="role">Role</label>
                              <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                 <option selected disabled hidden value="">-- Pilih role pengguna --</option>
                                 @if (old('role') == '1')
                                    <option value="1" selected>Admin</option>
                                    <option value="2">Guru</option>
                                    <option value="3">Tata Usaha</option>
                                 @elseif (old('role') == '2')
                                    <option value="1">Admin</option>
                                    <option value="2" selected>Guru</option>
                                    <option value="3">Tata Usaha</option>
                                 @elseif (old('role') == '3')
                                    <option value="1">Admin</option>
                                    <option value="2">Guru</option>
                                    <option value="3" selected>Tata Usaha</option>
                                 @else
                                    <option value="1">Admin</option>
                                    <option value="2">Guru</option>
                                    <option value="3">Tata Usaha</option>
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
                                 required>
                                 <option selected disabled hidden value="">-- Pilih pegawai --</option>
                                 @foreach ($pegawai as $p)
                                    @if (old('pegawai_id') == $p->id)
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
                           <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control @error('password') is-invalid @enderror"
                                 id="password" name="password" placeholder="Masukkan password pengguna"
                                 value="{{ old('password') }}" required autofocus>
                              @error('password')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-success">Tambah</button>
                           <a href="/pengguna" class="btn btn-secondary">Batal</a>
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
      $(function() {
         bsCustomFileInput.init();
      });
   </script>
@endsection
