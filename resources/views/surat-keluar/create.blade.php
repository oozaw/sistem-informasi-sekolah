@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Buat Surat Baru</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item">Surat Keluar</li>
                     <li class="breadcrumb-item active">Buat Surat Baru</li>
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
                     <form method="post" action="/surat-keluar-preview" onsubmit="previewSurat()"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="individu_tujuan">Individu Tujuan</label>
                                    <input type="text"
                                       class="form-control @error('individu_tujuan') is-invalid @enderror"
                                       id="individu_tujuan" name="individu_tujuan"
                                       placeholder="Masukkan individu tujuan surat" value="{{ old('individu_tujuan') }}"
                                       autofocus required>
                                    @error('individu_tujuan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tujuan">Instansi/Organisasi Tujuan</label>
                                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                       id="tujuan" name="tujuan" placeholder="Masukkan tujuan surat"
                                       value="{{ old('tujuan') }}" required>
                                    @error('tujuan')
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
                                    <label for="lampiran">Lampiran</label>
                                    <input type="text" class="form-control @error('lampiran') is-invalid @enderror"
                                       id="lampiran" name="lampiran" placeholder="Masukkan lampiran surat"
                                       value="{{ old('lampiran') }}">
                                    @error('lampiran')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control @error('perihal') is-invalid @enderror"
                                       id="perihal" name="perihal" placeholder="Masukkan perihal"
                                       value="{{ old('perihal') }}" required>
                                    @error('perihal')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="no_surat">No Surat</label>
                              <div class="form-row mb-0">
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                       placeholder="Nomor" value="{{ old('nomor') }}" required>
                                 </div>
                                 <div class="form-group mb mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="kode_tujuan" id="kode_tujuan"
                                       placeholder="Kode Tujuan" value="{{ old('kode_tujuan') }}" required>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="instansi_asal" id="instansi_asal"
                                       value="SMAN.5.Mrg" readonly>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <select class="form-control" name="bulan" id="bulan" required>
                                       @if (old('bulan') == 'I')
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
                                       @elseif (old('bulan') == 'II')
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
                                       @elseif (old('bulan') == 'III')
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
                                       @elseif (old('bulan') == 'IV')
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
                                       @elseif (old('bulan') == 'V')
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
                                       @elseif (old('bulan') == 'VI')
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
                                       @elseif (old('bulan') == 'VII')
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
                                       @elseif (old('bulan') == 'VIII')
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
                                       @elseif (old('bulan') == 'IX')
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
                                       @elseif (old('bulan') == 'X')
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
                                       @elseif (old('bulan') == 'XI')
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
                                       @elseif (old('bulan') == 'XII')
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
                                       @else
                                          <option value="" selected disabled hidden>-- Pilih bulan --
                                          </option>
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
                                          <option value="XII">Desember</option>
                                       @endif
                                    </select>
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>-</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control" name="tahun" id="tahun"
                                       placeholder="Tahun" value="{{ old('tahun') }}" required>
                                 </div>
                              </div>
                              @error('no_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tgl_keluar">Tanggal Keluar</label>
                                    <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                       id="tgl_keluar" name="tgl_keluar" placeholder="Masukkan tanggal keluar"
                                       value="{{ old('tgl_keluar') }}" required>
                                    @error('tgl_keluar')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
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
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="isi_surat">Isi Surat</label>
                              {{-- <input type="text" name="old_isi_surat" id="old_isi_surat" hidden
                                 value="{!! old('isi_surat') !!}"> --}}
                              <textarea name="isi_surat" id="isi_surat" class="form-control @error('isi_surat') is-invalid @enderror" required>
                                 {!! old('isi_surat') !!}
                              </textarea>
                              @error('isi_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           {{-- <label for="file_surat">File Surat</label>
                           <div class="custom-file mb-2">
                              <input type="file" class="custom-file-input @error('file_surat') is-invalid @enderror"
                                 id="file_surat" name="file_surat" required>
                              <label class="custom-file-label" for="file_surat" data-browse="Pilih file">Unggah file surat
                                 (*.pdf)</label>
                              @error('file_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div> --}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-success">Preview</button>
                           <a href="{{ URL::previous() }}" class="btn btn-secondary">Batal</a>
                           <a href="/untuk-print/download" class="btn bg-gradient-purple" id="print_button"
                              hidden>Print</a>
                        </div>
                     </form>
                     <hr class="mt-0">
                     <div id="iframe"></div>
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
   {{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}
   <script src="/ckeditor/build/ckeditor.js"></script>
   <script>
      $(function() {
         bsCustomFileInput.init();
      });

      ClassicEditor
         .create(document.querySelector('#isi_surat'))
         .catch(error => {
            console.error(error);
         });

      function previewSurat() {
         let iframe = document.querySelector("#iframe");
         let print = document.querySelector("#print_button");

         print.removeAttribute("hidden");
         iframe.innerHTML = '<iframe class="px-3 pb-3" height="800" src="" frameborder="0"></iframe>';
      }
   </script>
@endsection
