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
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item">Data Siswa</li>
                     <li class="breadcrumb-item active">Tambah Data Siswa</li>
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
                           <h4 class="m-0">Data Siswa Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/siswa">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                 name="nama" placeholder="Masukkan nama siswa" value="{{ old('nama') }}" autofocus>
                              @error('nama')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="nis">NIS</label>
                              <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                 name="nis" placeholder="Masukkan nis siswa" value="{{ old('nis') }}">
                              @error('nis')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="nisn">NISN</label>
                              <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                 name="nisn" placeholder="Masukkan nisn siswa" value="{{ old('nisn') }}">
                              @error('nisn')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                 <option selected disabled hidden value="">-- Pilih jenis kelamin --</option>
                                 @if (old('gender') == 'Laki-laki')
                                    <option value="Laki-laki" selected>Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                 @elseif (old('gender') == 'Perempuan')
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan" selected>Perempuan</option>
                                 @else
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                 @endif
                              </select>
                              @error('gender')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control @error('kelas') is-invalid @enderror" name="kelas_id">
                                 <option selected disabled hidden value="">-- Pilih kelas --</option>
                                 @foreach ($kelas as $k)
                                    @if (old('kelas_id') == $k->id)
                                       <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
                                    @else
                                       <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endif
                                 @endforeach
                              </select>
                              @error('kelas_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-success">Tambah</button>
                           <a href="/siswa" class="btn btn-secondary">Batal</a>
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
