@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="d-inline-flex"></div>
               <div class="col-sm-6">
                  <h1>Data Pengguna</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item active">Data Pengguna</li>
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
                           <a href="/pengguna/create" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Tambah Data Pengguna</a>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_pengguna" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th class="text-center">No.</th>
                                 <th>Nama Pengguna</th>
                                 <th class="text-center">Tipe Pengguna</th>
                                 <th class="text-center">Status</th>
                                 <th>Aktivitas Terakhir</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($pengguna as $p)
                                 <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $p->username }}</td>
                                    <td class="text-center align-middle">
                                       @if ($p->role == 1)
                                          {{ 'Admin' }}
                                       @elseif ($p->role == 2)
                                          {{ 'Guru' }}
                                       @elseif ($p->role == 3)
                                          {{ 'Tata Usaha' }}
                                       @else
                                          {{ 'Kepala Sekolah' }}
                                       @endif
                                    </td>
                                    <td class="text-center">
                                       @if (Cache::has('user-is-online-' . $p->id))
                                          <span data-tooltip="Online"><img src="/img/active-user.png" alt="online"
                                                style="width: 35px; height: 35px"></span>
                                          {{-- <span class="box bg-green btn-xs d-block text-center col-8 m-auto">Aktif</span> --}}
                                       @else
                                          <span data-tooltip="Offline"><img src="/img/non-active-user.png" alt="offline"
                                                style="width: 35px; height: 35px"></span>
                                          {{-- <span
                                             class="box bg-gray btn-xs d-block text-center col-8 m-auto">Non-aktif</span> --}}
                                       @endif
                                    </td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($p->last_seen)->diffForHumans() }}
                                    </td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/pengguna/{{ $p->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Lihat</a>
                                          <a href="/pengguna/{{ $p->id }}/edit" class="btn btn-primary btn-sm mr-1"
                                             {{ $p->role == '1' ? 'hidden' : '' }}>
                                             <i class="fas fa-edit"></i> Edit</a>
                                          @if (!Cache::has('user-is-online-' . $p->id))
                                             <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                                data-target="#modal-delete-{{ $p->id }}"
                                                {{ $p->role == '1' ? 'hidden' : '' }}>
                                                <i class="fas fa-trash"></i> Hapus</a>

                                             <!-- Modal -->
                                             <div class="modal fade" id="modal-delete-{{ $p->id }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                   <div class="modal-content bg-warning">
                                                      <div class="modal-header">
                                                         <h4 class="modal-title">Hapus Data Pengguna</h4>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <p>Yakin hapus data {{ $p->username }}?</p>
                                                      </div>
                                                      <div class="modal-footer justify-content-between">
                                                         <button type="button" class="btn btn-outline-dark"
                                                            data-dismiss="modal">Batal</button>
                                                         <form method="POST" action="/pengguna/{{ $p->id }}">
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
                                             <!-- /.modal -->
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
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         var table = $('#data_pengguna').DataTable({
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
                           columns: [0, 1, 2, 3, 4]
                        }
                     },
                     {
                        extend: 'excel',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     },
                     {
                        extend: 'pdf',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     },
                     {
                        extend: 'print',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     }
                  ]
               });

               api.buttons().container().appendTo('#data_pengguna_wrapper .col-md-6:eq(0)');
            }
         });
      });

      // $(function() {
      //    $("#data_pengguna").DataTable({
      //       "responsive": true,
      //       "lengthChange": false,
      //       "autoWidth": false,
      //       "buttons": [{
      //             extend: 'copy',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'excel',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'pdf',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'print',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          }
      //       ]
      //    }).buttons().container().appendTo('#data_pengguna_wrapper .col-md-6:eq(0)');
      // });
   </script>
@endsection
