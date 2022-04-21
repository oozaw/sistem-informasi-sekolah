@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Edit Surat Keluar</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item active">Surat Keluar</li>
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
                           <h4 class="m-0">Data Surat {{ $surat->tujuan }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/surat-keluar/{{ $surat->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="tujuan">Tujuan</label>
                              <input type="text" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan"
                                 name="tujuan" placeholder="Masukkan tujuan surat"
                                 value="{{ old('tujuan', $surat->tujuan) }}" autofocus>
                              @error('tujuan')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="no_surat">No Surat</label>
                              <div class="form-row">
                                 <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor">
                                 </div>
                                 <div class="form-group">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="kode_tujuan" id="kode_tujuan"
                                       placeholder="Kode Tujuan">
                                 </div>
                                 <div class="form-group">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="instansi" id="instansi"
                                       value="SMAN.5.Mrg" disabled>
                                 </div>
                                 <div class="form-group">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan">
                                 </div>
                                 <div class="form-group">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun">
                                 </div>
                              </div>
                              <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat"
                                 name="no_surat" placeholder="Masukkan No Surat"
                                 value="{{ old('no_surat', $surat->no_surat) }}">
                              @error('no_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="tgl_keluar">Tanggal Keluar</label>
                              <input type="text" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                 id="tgl_keluar" name="tgl_keluar" placeholder="Masukkan Tanggal Keluar"
                                 value="{{ old('tgl_keluar', $surat->tgl_keluar) }}">
                              @error('tgl_keluar')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                 id="keterangan" name="keterangan" placeholder="Masukkan keterangan"
                                 value="{{ old('keterangan', $surat->keterangan) }}">
                              @error('keterangan')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                           <a href="/surat-keluar" class="btn btn-secondary">Batal</a>
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
