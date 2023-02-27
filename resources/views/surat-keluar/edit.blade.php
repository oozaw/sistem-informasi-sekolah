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
                              <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                 id="tujuan" name="tujuan" placeholder="Masukkan tujuan surat"
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
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                       name="nomor" id="nomor" placeholder="Nomor"
                                       value="{{ old('nomor', $surat->nomor) }}">
                                    @error('nomor')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('kode_tujuan') is-invalid @enderror"
                                       name="kode_tujuan" id="kode_tujuan" placeholder="Kode tujuan"
                                       value="{{ old('kode_tujuan', $surat->kode_tujuan) }}">
                                    @error('kode_tujuan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('instansi_asal') is-invalid @enderror"
                                       name="instansi_asal" id="instansi_asal"
                                       value="{{ old('instansi_asal', $surat->instansi_asal) }}" required>
                                    @error('instansi_asal')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <select class="form-control @error('bulan') is-invalid @enderror" name="bulan"
                                       id="bulan" required>
                                       @if (old('bulan', $surat->bulan) == 'I')
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
                                       @elseif (old('bulan', $surat->bulan) == 'II')
                                          <option value="I">Januari</option>
                                          <option value="II" selected>Februari</option>
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
                                       @elseif (old('bulan', $surat->bulan) == 'III')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III" selected>Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'IV')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV" selected>April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'V')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V" selected>Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'VI')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI" selected>Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'VII')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII" selected>Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'VIII')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII" selected>Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'IX')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX" selected>September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'X')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X" selected>Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'XI')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI" selected>November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan', $surat->bulan) == 'XII')
                                          <option value="I">Januari</option>
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
                                          <option value="XII" selected>Desember</option>
                                       @endif
                                    </select>
                                    @error('bulan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('tahun') is-invalid @enderror"
                                       name="tahun" id="tahun" placeholder="Tahun"
                                       value="{{ old('tahun', $surat->tahun) }}">
                                    @error('tahun')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="tgl_keluar">Tanggal Keluar</label>
                              <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                 id="tgl_keluar" name="tgl_keluar" placeholder="Masukkan tanggal keluar"
                                 value="{{ old('tgl_keluar', $tanggal) }}">
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
                           <div class="form-group row mb-1">
                              <label for="option_file" class="col-form-label pr-0 mx-2 mr-3">Unggah Berkas Surat
                                 Baru:</label>
                              <div class="col-2 pl-0">
                                 <select class="form-control" name="option_file" id="option_file"
                                    onchange="cekUnggahSurat()" required>
                                    @if (old('option_file') == 'yes')
                                       <option value="no">Tidak</option>
                                       <option value="yes" selected>Ya</option>
                                    @else
                                       <option value="no" selected>Tidak</option>
                                       <option value="yes">Ya</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                           <div id="form_unggah_file"
                              @error('file_surat') @else
                           hidden @enderror>
                              <label for="file_surat">Berkas Surat (maks. 10MB)</label>
                              <div class="custom-file mb-2">
                                 <input type="file"
                                    class="custom-file-input @error('file_surat') is-invalid @enderror" id="file_surat"
                                    name="file_surat">
                                 <label class="custom-file-label" for="file_surat" data-browse="Pilih berkas">Unggah
                                    berkas
                                    surat
                                    (*.pdf)</label>
                                 @error('file_surat')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
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
      $(function() {
         bsCustomFileInput.init();
      });

      function cekUnggahSurat() {
         let option = document.querySelector("#option_file").value;
         let formUnggah = document.querySelector("#form_unggah_file");
         let inputFile = document.querySelector("#file_surat");

         if (option == "yes") {
            formUnggah.removeAttribute('hidden');
            // inputFile.setAttribute("required", true);
         } else {
            formUnggah.setAttribute('hidden', true);
            // inputFile.removeAttribute("required");
         }
      }
   </script>
@endsection
