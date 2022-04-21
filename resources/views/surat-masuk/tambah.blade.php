@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Tambah Surat Masuk</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item">Surat Masuk</li>
                     <li class="breadcrumb-item active">Tambah Surat Masuk</li>
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
                           <h4 class="m-0">Data Surat Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/surat-masuk" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="asal">Instansi/Organisasi Pengirim</label>
                              <input type="text" class="form-control @error('asal') is-invalid @enderror" id="asal"
                                 name="asal" placeholder="Masukkan pengirim surat" value="{{ old('asal') }}" autofocus
                                 required>
                              @error('asal')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="no_surat">No Surat</label>
                              <div class="form-row mb-0">
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor"
                                       value="{{ old('nomor') }}" required>
                                 </div>
                                 <div class="form-group mb mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="kode_tujuan" id="kode_tujuan"
                                       placeholder="Kode Tujuan" value="SMAN.5.Mrg" readonly required>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="instansi_asal" id="instansi_asal"
                                       value="{{ old('instansi_asal') }}" placeholder="Instansi Pengirim" required>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <select class="form-control" name="bulan" id="bulan" required>
                                       <option value="" disabled hidden>-- Pilih bulan --
                                       </option>
                                       <option value="I" selected>Januari</option>
                                       <option value="II">Februari</option>
                                       <option value="III">Maret</option>
                                       <option value="IV">April</option>
                                       <option value="V">Mei</option>
                                       <option value="VI">Juni</option>
                                       <option value="VII">Juli</option>
                                       <option value="VIII">Agustus</option>
                                       <option value="IX">September</option>
                                       <option value="X">Oktober</option>
                                       <option value="XI">November</option>
                                       <option value="XII">Desember</option>
                                    </select>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>-</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun"
                                       value="{{ old('tahun') }}" required>
                                 </div>
                              </div>
                              @error('no_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="tgl_masuk">Tanggal Masuk</label>
                              <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                 id="tgl_masuk" name="tgl_masuk" placeholder="Masukkan Tanggal masuk"
                                 value="{{ old('tgl_masuk') }}" required>
                              @error('tgl_masuk')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                 id="keterangan" name="keterangan" placeholder="Masukkan keterangan"
                                 value="{{ old('keterangan') }}">
                              @error('keterangan')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <label for="file_surat">File Surat</label>
                           <div class="custom-file mb-2">
                              <input type="file" class="custom-file-input" id="file_surat" name="file_surat"
                                 value="{{ old('file_surat') }}" required>
                              <label class="custom-file-label" for="file_surat" data-browse="Pilih file">Unggah file surat
                                 (*.pdf)</label>
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-success">Tambah</button>
                           <a href="/surat-masuk" class="btn btn-secondary">Batal</a>
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
