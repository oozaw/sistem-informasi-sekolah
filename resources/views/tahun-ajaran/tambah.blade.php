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
                     <li class="breadcrumb-item active">Tambah Tahun Pelajaran</li>
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
                           <h4 class="m-0">Data Tahun Pelajaran Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/tahun-ajaran" id="form_tambah" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Pelajaran</label>
                                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                       id="tahun_ajaran" name="tahun_ajaran" placeholder="Masukkan tahun pelajaran"
                                       value="{{ old('tahun_ajaran') }}" autofocus>
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
                                    <select class="form-control @error('status') is-invalid @enderror" name="status"
                                       id="status">
                                       <option selected disabled hidden value="">-- Pilih status --</option>
                                       @if (old('status') == '1')
                                          <option value="1" selected>Baru</option>
                                          <option value="0">Lama</option>
                                       @elseif (old('status') == '0')
                                          <option value="1">Baru</option>
                                          <option value="0" selected>Lama</option>
                                       @else
                                          <option value="1">Baru</option>
                                          <option value="0">Lama</option>
                                       @endif
                                    </select>
                                    @error('status')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div id="form_data"></div>
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

                  // format form rupiah
                  var rupiah = document.querySelector("#rupiah");
                  rupiah.addEventListener("input", function(e) {
                     // tambahkan 'Rp.' pada saat form di ketik
                     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                     rupiah.value = formatRupiah(this.value, "Rp. ");
                  });
               }
            });
         });
      });

      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix) {
         var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

         // tambahkan titik jika yang di input sudah menjadi angka ribuan
         if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
         }

         rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
         return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
      }

      $(function() {
         bsCustomFileInput.init();
      });
   </script>
@endsection
