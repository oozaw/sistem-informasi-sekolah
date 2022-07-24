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
                     <li class="breadcrumb-item">Tahun Pelajaran</li>
                     <li class="breadcrumb-item active">Edit Tahun Pelajaran</li>
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
                           <h4 class="m-0">Data Tahun Pelajaran {{ $ta->tahun_ajaran }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/tahun-ajaran/{{ $ta->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Pelajaran</label>
                                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                       id="tahun_ajaran" name="tahun_ajaran" placeholder="Masukkan tahun pelajaran"
                                       value="{{ old('tahun_ajaran', $ta->tahun_ajaran) }}" autofocus>
                                    @error('tahun_ajaran')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control @error('status') is-invalid @enderror"
                                       id="status" name="status" value="{{ $ta->status == 1 ? 'Aktif' : 'Non-Aktif' }}"
                                       readonly>
                                    @error('status')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           @if ($ta->status != 1)
                              <div id="form_data">
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="jml_siswa">Jumlah Keseluruhan Siswa</label>
                                          <input type="text"
                                             class="form-control @error('jml_siswa') is-invalid @enderror" id="jml_siswa"
                                             name="jml_siswa" placeholder="Masukkan jumlah keseluruhan siswa"
                                             value="{{ old('jml_siswa', $ta->jml_siswa) }}">
                                          @error('jml_siswa')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                             </div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="jml_siswa_baru">Jumlah Siswa Baru</label>
                                          <input type="text"
                                             class="form-control @error('jml_siswa_baru') is-invalid @enderror"
                                             id="jml_siswa_baru" name="jml_siswa_baru"
                                             placeholder="Masukkan jumlah siswa baru"
                                             value="{{ old('jml_siswa_baru', $ta->jml_siswa_baru) }}">
                                          @error('jml_siswa_baru')
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
                                          <label for="jml_siswa_lulus">Jumlah Siswa Lulus</label>
                                          <input type="text"
                                             class="form-control @error('jml_siswa_lulus') is-invalid @enderror"
                                             id="jml_siswa_lulus" name="jml_siswa_lulus"
                                             placeholder="Masukkan jumlah siswa lulus"
                                             value="{{ old('jml_siswa_lulus', $ta->jml_siswa_lulus) }}">
                                          @error('jml_siswa_lulus')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                             </div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="jml_siswa_keluar">Jumlah Siswa Keluar/Pindah</label>
                                          <input type="text"
                                             class="form-control @error('jml_siswa_keluar') is-invalid @enderror"
                                             id="jml_siswa_keluar" name="jml_siswa_keluar"
                                             placeholder="Masukkan jumlah siswa keluar/pindah"
                                             value="{{ old('jml_siswa_keluar', $ta->jml_siswa_keluar) }}">
                                          @error('jml_siswa_keluar')
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
                                          <label for="jml_prestasi">Jumlah Prestasi</label>
                                          <input type="text"
                                             class="form-control @error('jml_prestasi') is-invalid @enderror"
                                             id="jml_prestasi" name="jml_prestasi" placeholder="Masukkan jumlah prestasi"
                                             value="{{ old('jml_prestasi', $ta->jml_prestasi) }}">
                                          @error('jml_prestasi')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                             </div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="jml_pegawai">Jumlah Pegawai</label>
                                          <input type="text"
                                             class="form-control @error('jml_pegawai') is-invalid @enderror"
                                             id="jml_pegawai" name="jml_pegawai" placeholder="Masukkan jumlah pegawai"
                                             value="{{ old('jml_pegawai', $ta->jml_pegawai) }}">
                                          @error('jml_pegawai')
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
                                          <label for="jml_surat_masuk">Jumlah Surat Masuk</label>
                                          <input type="text"
                                             class="form-control @error('jml_surat_masuk') is-invalid @enderror"
                                             id="jml_surat_masuk" name="jml_surat_masuk"
                                             placeholder="Masukkan jumlah surat masuk"
                                             value="{{ old('jml_surat_masuk', $ta->jml_surat_masuk) }}">
                                          @error('jml_surat_masuk')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                             </div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="jml_surat_keluar">Jumlah Surat Keluar</label>
                                          <input type="text"
                                             class="form-control @error('jml_surat_keluar') is-invalid @enderror"
                                             id="jml_surat_keluar" name="jml_surat_keluar"
                                             placeholder="Masukkan jumlah surat keluar"
                                             value="{{ old('jml_surat_keluar', $ta->jml_surat_keluar) }}">
                                          @error('jml_surat_keluar')
                                             <div class="invalid-feedback">
                                                {{ $message }}
                                             </div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           @endif
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
   <script src="/jquery/jquery-3.6.0.min.js"></script>
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
         $("#status").on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('tahun-ajaran-get-data-form') }}",
               method: 'post',
               data: {
                  status: $("#status").val(),
               },
               beforeSend: function() {
                  $("#form_data").text('');
               },
               success: function(result) {
                  $("#form_data").append(result);
                  $("#jml_siswa_tinggal_kelas").on('input', function(e) {
                     e.preventDefault();
                     $.ajaxSetup({
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                     });

                     $.ajax({
                        url: "{{ url('tahun-ajaran-get-siswa-option') }}",
                        method: 'post',
                        data: {
                           jml_siswa: $("#jml_siswa_tinggal_kelas").val(),
                        },
                        beforeSend: function() {
                           $("#form_siswa_tinggal_kelas").text('');
                        },
                        success: function(result) {
                           $("#form_siswa_tinggal_kelas").append(result);
                        }
                     });
                  });
               }
            });
         });
      });

      $(function() {
         bsCustomFileInput.init();
      });
   </script>
@endsection
