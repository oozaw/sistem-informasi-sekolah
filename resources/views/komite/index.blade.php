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
                  <h1>Data Pembayaran Komite</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item active">Pembayaran Komite</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <a href="/bebas-komite" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Input Data Siswa Bebas Komite</a>
                           <form method="POST" action="/komite-export" target="_blank">
                              @csrf
                              <input class="form-control" name="semester_hidden" id="semester_hidden" type="text"
                                 value="{{ $tgl->month > 6 ? 'Ganjil' : 'Genap' }}" required hidden>
                              <button type="submit" class="btn bg-gradient-purple btn-sm mr-1" id="export">
                                 <i class="fas fa-file-download"></i> Ekspor Excel Data Pembayaran</button>
                           </form>
                           <div id="alert"></div>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <form id="form" method="POST" enctype="multipart/form-data">
                           <div class="form-group row mb-3">
                              <label for="semester" class="col-form-label pr-0 mx-2 mr-3">Semester</label>
                              <div class="col-2 pl-0 mr-3">
                                 <select class="form-control get-data" name="semester" id="semester" required>
                                    <option value="Ganjil" {{ $tgl->month > 6 ? 'selected' : '' }}>Ganjil</option>
                                    <option value="Genap" {{ $tgl->month <= 6 ? 'selected' : '' }}>Genap</option>
                                 </select>
                              </div>
                              <label for="kelas" class="col-form-label pr-0 mx-2 mr-3">Kelas</label>
                              <div class="col-2 pl-0 mr-3">
                                 <select class="form-control get-data" name="kelas" id="kelas" required>
                                    <option value="" selected hidden disabled>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                       <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div id="data"></div>
                           <div id="loader"></div>
                        </form>
                     </div>
                     <!-- /.card-body -->
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
   <!-- DataTables  & Plugins -->
   <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/jszip/jszip.min.js"></script>
   <script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
   <script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   <!-- SweetAlert2 -->
   <script src="/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
   <!-- Toastr -->
   <script src="/adminlte/plugins/toastr/toastr.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         $(".get-data").on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('komite-data') }}",
               method: 'post',
               data: {
                  semester: $("#semester").val(),
                  kelas: $("#kelas").val()
               },
               beforeSend: function() {
                  $("#data").text('');
                  warnaStatus();
                  copySemesterValue();
               },
               success: function(result) {
                  if (result.status == 0) {
                     $("#data").append(result.page);
                  } else {
                     $("#data").append(result);
                     warnaStatus();
                     getRupiah();
                     ajaxUpdate();
                     copySemesterValue();
                  }
               }
            });
         });

         // $("#export").on('click', function(e) {
         //    e.preventDefault();
         //    $.ajaxSetup({
         //       headers: {
         //          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         //       }
         //    });

         //    $.ajax({
         //       url: "{{ url('komite-export') }}",
         //       method: 'post',
         //       data: {
         //          semester: $("#semester").val(),
         //       },
         //       success: function(result) {
         //       }
         //    });
         // });
      });

      $(document).on({
         ajaxStart: function() {
            $("body").addClass("loading");
            $("#loader").addClass('overlay');
         },
         ajaxStop: function() {
            $("#loader").removeClass('overlay');
            $("body").removeClass("loading");
         }
      });

      function copySemesterValue() {
         var value = $("#semester").val();
         $("#semester_hidden").val(value);
      }

      function warnaStatus() {
         var bln_awal = "";
         if ($("#semester").val() == "Ganjil") {
            bln_awal = 7;
         } else {
            bln_awal = 1;
         }

         @foreach ($komite as $ko)
            var status = $(".daftar_ulang_{{ $ko->id }}");
            if (status.val() == "Lunas" || status.val() == "0" || status.val() == "Rp. 0") {
               status.removeClass("bg-warning");
               status.addClass("bg-success");
            } else {
               status.removeClass("bg-success");
               status.addClass("bg-warning");
            }

            if ($("#semester").val() == "Genap") {
               status = $("#komite1_{{ $ko->id }}");
               if (status.val() == "Lunas") {
                  status.removeClass("bg-warning");
                  status.addClass("bg-success");
               } else {
                  status.removeClass("bg-success");
                  status.addClass("bg-warning");
               }
            }

            for (let i = bln_awal; i <= bln_awal + 5; i++) {
               status = $("#komite_{{ $ko->id }}_" + i);
               if (status.val() == "Lunas") {
                  status.removeClass("bg-warning");
                  status.addClass("bg-success");
               } else {
                  status.removeClass("bg-success");
                  status.addClass("bg-warning");
               }
            }
         @endforeach
      }

      function ajaxUpdate() {
         $("#button_simpan").on('click', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            // data
            var data = new FormData($("#form")[0]);

            $.ajax({
               url: "{{ url('komite-update') }}",
               method: 'post',
               data: data,
               processData: false,
               contentType: false,
               beforeSend: function() {
                  $("#alert").text('');
               },
               success: function(result) {
                  $("#alert").append(result.alert);
                  cekAlert();
               }
            });
         });
      }

      function getRupiah() {
         @foreach ($komite as $ko)
            if (document.getElementById("rupiah_{{ $ko->id }}")) {
               var rupiah_{{ $ko->id }} = document.getElementById("rupiah_{{ $ko->id }}");
               rupiah_{{ $ko->id }}.addEventListener("input", function(e) {
                  // tambahkan 'Rp.' pada saat form di ketik
                  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                  rupiah_{{ $ko->id }}.value = formatRupiah(this.value, "Rp. ");
               });
            }
         @endforeach
      }

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

      function cekAlert() {
         if ($('.successAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-success mt-1 mr-1',
               title: 'Berhasil',
               autohide: true,
               delay: 5000,
               body: $('.successAlert').text()
            });
         }

         if ($('.warningAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-warning',
               title: 'Toast Title',
               autohide: true,
               delay: 5000,
               subtitle: 'Subtitle',
               body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            });
         }

         if ($('.failAlert').length) {
            $(document).Toasts('create', {
               class: 'bg-danger',
               title: 'Toast Title',
               autohide: true,
               delay: 5000,
               body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            });
         }

      };
   </script>
@endsection
