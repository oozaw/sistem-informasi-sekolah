@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Surat Masuk</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item active">Surat Masuk</li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <a href="/surat-masuk/create" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Tambah Surat Masuk</a>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_surat_masuk" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Asal</th>
                                 <th>No. Surat</th>
                                 <th>Tanggal Masuk</th>
                                 <th>Keterangan</th>
                                 <th hidden>Link File</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($surat_masuk as $sm)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sm->asal }}</td>
                                    <td>{{ "$sm->nomor/$sm->kode_tujuan/$sm->instansi_asal/$sm->bulan-$sm->tahun" }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sm->tgl_masuk)->isoFormat('DD-MM-Y') }}</td>
                                    <td>{{ $sm->keterangan }}</td>
                                    <td hidden>{{ url("/$sm->file_surat") }}</td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/surat-masuk/{{ $sm->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Detail</a>
                                          <a href="/surat-masuk/{{ $sm->id }}/edit"
                                             class="btn btn-primary btn-sm mr-1">
                                             <i class="fas fa-edit"></i> Edit</a>
                                          <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                             data-target="#modal-delete-{{ $sm->id }}">
                                             <i class="fas fa-trash"></i> Hapus</a>

                                          <!-- Modal -->
                                          <div class="modal fade" id="modal-delete-{{ $sm->id }}"
                                             style="display: none;" aria-hidden="true">
                                             <div class="modal-dialog">
                                                <div class="modal-content bg-warning">
                                                   <div class="modal-header">
                                                      <h4 class="modal-title">Hapus Data Surat</h4>
                                                      <button type="button" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <span aria-hidden="true">×</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <p>Yakin hapus data surat dari {{ $sm->asal }}?</p>
                                                   </div>
                                                   <div class="modal-footer justify-content-between">
                                                      <button type="button" class="btn btn-outline-dark"
                                                         data-dismiss="modal">Batal</button>
                                                      <form method="POST" action="/surat-masuk/{{ $sm->id }}">
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
      $(function() {
         $("#data_surat_masuk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                  extend: 'copy',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5]
                  }
               },
               {
                  extend: 'excel',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5]
                  }
               },
               {
                  extend: 'pdf',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5]
                  }
               },
               {
                  extend: 'print',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5]
                  }
               }
            ]
         }).buttons().container().appendTo('#data_surat_masuk_wrapper .col-md-6:eq(0)');
      });
   </script>
@endsection
