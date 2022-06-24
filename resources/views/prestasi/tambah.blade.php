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
                     <li class="breadcrumb-item">Data Prestasi</li>
                     <li class="breadcrumb-item active">Tambah Data Prestasi</li>
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
                           <h4 class="m-0">Data Prestasi Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/prestasi" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="nama">Nama Perlombaan</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" placeholder="Masukkan nama lomba"
                                       value="{{ old('nama') }}" autofocus>
                                    @error('nama')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Jenis Perlombaan</label>
                                    <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                       <option selected disabled hidden value="">-- Pilih jenis lomba --</option>
                                       @if (old('jenis') == 'Individu')
                                          <option value="Individu" selected>Individu</option>
                                          <option value="Kelompok">Kelompok</option>
                                       @elseif (old('jenis') == 'Kelompok')
                                          <option value="Individu">Individu</option>
                                          <option value="Kelompok" selected>Kelompok</option>
                                       @else
                                          <option value="Individu">Individu</option>
                                          <option value="Kelompok">Kelompok</option>
                                       @endif
                                    </select>
                                    @error('jenis')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tingkat">Tingkat Perlombaan</label>
                                    <input type="text" class="form-control @error('tingkat') is-invalid @enderror"
                                       id="tingkat" name="tingkat" placeholder="Masukkan tingkat lomba"
                                       value="{{ old('tingkat') }}">
                                    @error('tingkat')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="capaian">Capaian</label>
                                    <input type="text" class="form-control @error('capaian') is-invalid @enderror"
                                       id="capaian" name="capaian" placeholder="Masukkan capaian prestasi"
                                       value="{{ old('capaian') }}">
                                    @error('capaian')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tanggal">Tanggal Pelaksanaan</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                       id="tanggal" name="tanggal" placeholder="Masukkan tanggal pelaksanaan"
                                       value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Bidang</label>
                                    <select class="form-control @error('bidang') is-invalid @enderror" name="bidang">
                                       <option selected disabled hidden value="">-- Pilih bidang prestasi --</option>
                                       @if (old('bidang') == 'Akademik')
                                          <option value="Akademik" selected>Akademik</option>
                                          <option value="Non-Akademik">Non-Akademik</option>
                                       @elseif (old('bidang') == 'Non-Akademik')
                                          <option value="Akademik">Akademik</option>
                                          <option value="Non-Akademik" selected>Non-Akademik</option>
                                       @else
                                          <option value="Akademik">Akademik</option>
                                          <option value="Non-Akademik">Non-Akademik</option>
                                       @endif
                                    </select>
                                    @error('bidang')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <label for="piagam">File Piagam</label>
                           <div class="custom-file mb-2">
                              <input type="file" class="custom-file-input @error('piagam') is-invalid @enderror"
                                 id="piagam" name="piagam">
                              <label class="custom-file-label" for="piagam" data-browse="Pilih file">Unggah file piagam
                                 (*.pdf)</label>
                              @error('piagam')
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

      function cekJenisLomba() {
         let
      }
   </script>
@endsection
