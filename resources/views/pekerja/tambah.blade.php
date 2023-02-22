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
                     <li class="breadcrumb-item">Kepegawaian</li>
                     <li class="breadcrumb-item">Data Pegawai</li>
                     <li class="breadcrumb-item active">Tambah Data Pegawai</li>
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
                           <h4 class="m-0">Data Pegawai Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/pekerja" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" placeholder="Masukkan nama"
                                       value="{{ old('nama') }}" autofocus>
                                    @error('nama')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
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
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan">
                                       <option selected disabled hidden value="">-- Pilih jabatan --</option>
                                       @if (old('jabatan') == 'Guru')
                                          <option value="Guru" selected>Guru</option>
                                          <option value="Staf Tata Usaha">Staf Tata Usaha</option>
                                          <option value="Staf Lainnya">Staf Lainnya</option>
                                       @elseif (old('jabatan') == 'Staf Tata Usaha')
                                          <option value="Guru">Guru</option>
                                          <option value="Staf Tata Usaha" selected>Staf Tata Usaha</option>
                                          <option value="Staf Lainnya">Staf Lainnya</option>
                                       @elseif (old('jabatan') == 'Staf Lainnya')
                                          <option value="Guru">Guru</option>
                                          <option value="Staf Tata Usaha">Staf Tata Usaha</option>
                                          <option value="Staf Lainnya" selected>Staf Lainnya</option>
                                       @else
                                          <option value="Guru">Guru</option>
                                          <option value="Staf Tata Usaha">Staf Tata Usaha</option>
                                          <option value="Staf Lainnya">Staf Lainnya</option>
                                       @endif
                                    </select>
                                    @error('jabatan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                       id="nip" name="nip" placeholder="Masukkan NIP"
                                       value="{{ old('nip') }}">
                                    @error('nip')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" placeholder="Masukkan email"
                                       value="{{ old('email') }}">
                                    @error('email')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="no_hp">No. Telepon</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                       id="no_hp" name="no_hp" placeholder="Masukkan no HP"
                                       value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="tempat_tinggal">Tempat Tinggal</label>
                              <input type="text" class="form-control @error('tempat_tinggal') is-invalid @enderror"
                                 id="tempat_tinggal" name="tempat_tinggal" placeholder="Masukkan tempat tinggal"
                                 value="{{ old('tempat_tinggal') }}">
                              @error('tempat_tinggal')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <label for="foto_profil">Foto Profil (maks. 10MB)</label>
                           <div class="custom-file mb-2">
                              <input type="file" class="custom-file-input @error('foto_profil') is-invalid @enderror"
                                 id="foto_profil" name="foto_profil">
                              <label class="custom-file-label" for="foto_profil" data-browse="Pilih berkas">Unggah foto
                                 profil (.jpg, .png, .jpeg)</label>
                              @error('foto_profil')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-success">Tambah</button>
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
      $(function() {
         bsCustomFileInput.init();
      });
   </script>
@endsection
