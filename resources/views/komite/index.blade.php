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
                           <a href="/komite" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Input Data Siswa Bebas Komite</a>
                           <a href="/komite" class="btn bg-gradient-purple btn-sm mr-1">
                              <i class="fas fa-file-download"></i> Ekspor Excel Data Pembayaran</a>
                           {{-- <a href="/komite" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Input Data Siswa Bebas Komite</a> --}}
                           @if (session()->has('success'))
                              <div class="successAlert" hidden>{{ session('success') }}</div>
                           @endif
                           @if (session()->has('fail'))
                              <div class="failAlert" hidden>{{ session('fail') }}</div>
                           @endif
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="form-group row mb-3">
                           <label for="semester" class="col-form-label pr-0 mx-2 mr-3">Semester</label>
                           <div class="col-2 pl-0 mr-3">
                              <select class="form-control get-data" name="semester" id="semester" onchange="getKomite()"
                                 required>
                                 <option value="Ganjil" {{ $tgl->month <= 6 ? 'selected' : '' }}>Ganjil</option>
                                 <option value="Genap" {{ $tgl->month > 6 ? 'selected' : '' }}>Genap</option>
                              </select>
                           </div>
                           <label for="kelas" class="col-form-label pr-0 mx-2 mr-3">Kelas</label>
                           <div class="col-2 pl-0 mr-3">
                              <select class="form-control get-data" name="kelas" id="kelas" onchange="getKomite()"
                                 required>
                                 <option value="" selected hidden disabled>-- Pilih Kelas --</option>
                                 @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div id="data">
                           {{-- <div class="row">
                              <div class="col-3 px-0">
                                 <table class="table table-responsive table-borderless" style="white-space: nowrap">
                                    <thead>
                                       <tr>
                                          <th class="text-center align-middle pl-1" style="width: 3%">No.</th>
                                          <th class="align-middle" style="padding-left: 18%">Nama</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($komite as $ko)
                                          <tr>
                                             <td class="text-center pl-0">{{ $loop->iteration }}</td>
                                             <td style="height: 50px" class="pl-0">{{ $ko->siswa->nama }}</td>
                                          </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                              <div class="container-fluid col-9 px-0">
                                 <table class="table table-responsive table-borderless">
                                    <thead>
                                       <tr class="d-flex">
                                          @if ($semester == 2)
                                             <th class="col-2 text-center">Januari</th>
                                             <th class="col-2 text-center">Februari</th>
                                             <th class="col-2 text-center">Maret</th>
                                             <th class="col-2 text-center">April</th>
                                             <th class="col-2 text-center">Mei</th>
                                             <th class="col-2 text-center">Juni</th>
                                          @else
                                             <th class="col-2 text-center">Juli</th>
                                             <th class="col-2 text-center">Agustus</th>
                                             <th class="col-2 text-center">September</th>
                                             <th class="col-2 text-center">Oktober</th>
                                             <th class="col-2 text-center">November</th>
                                             <th class="col-2 text-center">Desember</th>
                                          @endif
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($komite as $ko)
                                          <tr class="d-flex">
                                             @for ($i = $bln_awal; $i <= $bln_awal + 5; $i++)
                                                <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                                                   <div class="pl-0">
                                                      <select class="form-control"
                                                         name="komite_{{ $ko->id }}_{{ $i }}"
                                                         id="komite_{{ $ko->id }}_{{ $i }}"
                                                         onchange="warnaStatus()" required>
                                                         @if ($ko->$i == 'Belum Lunas')
                                                            <option class="" value="Belum Lunas" selected>Belum Lunas
                                                            </option>
                                                            <option value="Lunas">Lunas</option>
                                                         @elseif ($ko->$i == 'Lunas')
                                                            <option value="Belum Lunas">Belum Lunas</option>
                                                            <option value="Lunas" selected>Lunas</option>
                                                         @else
                                                            <option value="" selected hidden disabled>-- Pilih Status
                                                               --
                                                            </option>
                                                            <option value="Belum Lunas">Belum Lunas</option>
                                                            <option value="Lunas">Lunas</option>
                                                         @endif
                                                      </select>
                                                   </div>
                                                </td>
                                             @endfor
                                          </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                              <a href="/komite-simpan" class="d-block col-auto btn btn-primary ml-auto mr-3">Simpan</a>
                           </div> --}}
                        </div>
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
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
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
               },
               success: function(result) {
                  $("#data").append(result);
                  warnaStatus();
               }
            });
         });
      });

      function warnaStatus() {
         var bln_awal = "";
         if ($("#semester").val() == "Ganjil") {
            bln_awal = 1;
         } else {
            bln_awal = 7;
         }

         @foreach ($komite as $ko)
            for (let i = bln_awal; i <= bln_awal + 5; i++) {
               var status = $("#komite_{{ $ko->id }}_" + i);
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

      $(function() {
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
               subtitle: 'Subtitle',
               body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            });
         }

      });
   </script>
@endsection
