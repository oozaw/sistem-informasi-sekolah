@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Tahun Pelajaran</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item active">Tahun Pelajaran</li>
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
                           <a href="/tahun-ajaran/create" class="btn btn-success btn-sm mt-1 mr-1">
                              <i class="fas fa-layer-plus mr-1"></i> Tambah Tahun Pelajaran</a>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_tahun_ajaran" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th id="thead_0">No.</th>
                                 <th id="thead_1">Tahun</th>
                                 <th id="thead_2">Status</th>
                                 <th id="thead_3">Jumlah Siswa</th>
                                 <th id="thead_4" hidden>Jumlah Siswa Baru</th>
                                 <th id="thead_5" hidden>Jumlah Siswa Lulus</th>
                                 <th id="thead_6" hidden>Jumlah Siswa Keluar</th>
                                 <th id="thead_7">Jumlah Prestasi</th>
                                 <th id="thead_8" hidden>Jumlah Pegawai</th>
                                 <th id="thead_9" hidden>Jumlah Surat Masuk</th>
                                 <th id="thead_10" hidden>Jumlah Surat Keluar</th>
                                 <th id="thead_11">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($tahun_ajaran as $ta)
                                 <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ta->tahun_ajaran }}</td>
                                    <td>
                                       <span
                                          class="text-bold {{ $ta->status == '1' ? 'text-success' : 'text-secondary' }}">
                                          {{ $ta->status == 1 ? 'Aktif' : 'Non-aktif' }}</span>
                                       {{-- <span
                                          class="box {{ $ta->status == '1' ? 'bg-green' : 'bg-gray' }} btn-sm d-block text-center m-auto">
                                          {{ $ta->status == 1 ? 'Aktif' : 'Non-aktif' }}
                                       </span> --}}
                                    </td>
                                    <td>{{ $ta->jml_siswa }}</td>
                                    <td hidden>{{ $ta->jml_siswa_baru }}</td>
                                    <td hidden>{{ $ta->jml_siswa_lulus }}</td>
                                    <td hidden>{{ $ta->jml_siswa_keluar }}</td>
                                    <td>{{ $ta->jml_prestasi }}</td>
                                    <td hidden>{{ $ta->jml_pegawai }}</td>
                                    <td hidden>{{ $ta->jml_surat_masuk }}</td>
                                    <td hidden>{{ $ta->jml_surat_keluar }}</td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/tahun-ajaran/{{ $ta->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Lihat</a>
                                          <a href="/tahun-ajaran/{{ $ta->id }}/edit"
                                             class="btn btn-primary btn-sm mr-1">
                                             <i class="fas fa-edit"></i> Edit</a>
                                          @if ($ta->status != '1')
                                             <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                                data-target="#modal-delete-{{ $ta->id }}">
                                                <i class="fas fa-trash"></i> Hapus</a>

                                             <!-- Modal Delete-->
                                             <div class="modal fade" id="modal-delete-{{ $ta->id }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                   <div class="modal-content bg-warning">
                                                      <div class="modal-header">
                                                         <h4 class="modal-title">Hapus Data Tahun Pelajaran</h4>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                         <p>Yakin hapus data tahun pelajaran {{ $ta->tahun_ajaran }}?</p>
                                                      </div>
                                                      <div class="modal-footer justify-content-between">
                                                         <button type="button" class="btn btn-outline-dark"
                                                            data-dismiss="modal">Batal</button>
                                                         <form method="POST" action="/tahun-ajaran/{{ $ta->id }}">
                                                            @method('delete')
                                                            @csrf
                                                            <button onclick="return true"
                                                               class="btn btn-danger">Hapus</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                   <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                             </div>
                                             <!-- /.modal delete -->
                                          @endif


                                       </div>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
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
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- bs-custom-file-input -->
   <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
   <script src="/js/dataTables.export.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         var table = $('#data_tahun_ajaran').DataTable({
            language: {
               url: "{{ url('/json/dataTable-id.json') }}"
            },
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            initComplete: function() {
               var api = this.api();

               new $.fn.dataTable.Buttons(api, {
                  buttons: [{
                        extend: 'copy',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                     },
                     {
                        extend: 'excel',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                     },
                     {
                        text: 'Word',
                        action: function(e, dt, node, config) {
                           var date = new Date();
                           var time = date.toLocaleString();
                           $.fn.DataTable.Export.word(dt, {
                              filename: $("#title").text(),
                              title: $("#title").text(),
                              message: 'Di ekspor pada ' + time,
                              header: [
                                 $("#thead_0").text(),
                                 $("#thead_1").text(),
                                 $("#thead_2").text(),
                                 $("#thead_3").text(),
                                 $("#thead_4").text(),
                                 $("#thead_5").text(),
                                 $("#thead_6").text(),
                                 $("#thead_7").text(),
                                 $("#thead_8").text(),
                                 $("#thead_9").text(),
                                 $("#thead_10").text(),
                              ],
                              fields: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                           });
                        }
                     },
                     {
                        extend: 'pdf',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                     },
                     {
                        extend: 'print',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                     }
                  ]
               });

               api.buttons().container().appendTo('#data_tahun_ajaran_wrapper .col-md-6:eq(0)');
            }
         });
      });

      $(function() {
         bsCustomFileInput.init();
      });

      // $(function() {
      //    $("#data_tahun_ajaran").DataTable({
      //       "language": {
      //          "url": "{{ url('/json/dataTable-id.json') }}"
      //       },
      //       "responsive": true,
      //       "lengthChange": false,
      //       "autoWidth": false,
      //       "buttons": [{
      //             extend: 'copy',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
      //             }
      //          },
      //          {
      //             extend: 'excel',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
      //             }
      //          },
      //          {
      //             extend: 'pdf',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
      //             }
      //          },
      //          {
      //             extend: 'print',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
      //             }
      //          }
      //       ]
      //    }).buttons().container().appendTo('#data_tahun_ajaran_wrapper .col-md-6:eq(0)');
      // });
   </script>
@endsection
