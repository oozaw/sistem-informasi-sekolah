@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Pegawai Lain</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Kepegawaian</li>
                     <li class="breadcrumb-item active">Data Staf Lain</li>
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
                           @can('tata-usaha')
                              <a href="/pekerja/create" class="btn btn-success btn-sm mr-1">
                                 <i class="fas fa-file-plus"></i> Tambah Data Pegawai</a>
                           @endcan
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_staf_lain" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Nama</th>
                                 <th>Jabatan</th>
                                 <th>NIP</th>
                                 <th hidden>Jenis Kelamin</th>
                                 <th hidden>No. Telepon</th>
                                 <th hidden>Email</th>
                                 <th>Tempat Tinggal</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($staf as $s)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->jabatan }}</td>
                                    <td>{{ $s->nip }}</td>
                                    <td hidden>{{ $s->gender }}</td>
                                    <td hidden>{{ $s->no_hp }}</td>
                                    <td hidden>{{ $s->email }}</td>
                                    <td>{{ $s->tempat_tinggal }}</td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/pekerja/{{ $s->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Lihat</a>
                                          @can('tata-usaha')
                                             <a href="/pekerja/{{ $s->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                                <i class="fas fa-edit"></i> Edit</a>
                                             <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                                data-target="#modal-delete-{{ $s->id }}">
                                                <i class="fas fa-trash"></i> Hapus</a>
                                             <!-- Modal -->
                                             <div class="modal fade" id="modal-delete-{{ $s->id }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                   <div class="modal-content bg-warning">
                                                      <div class="modal-header">
                                                         <h4 class="modal-title">Hapus Data Pegawai</h4>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <p>Yakin hapus data pegawai {{ $s->nama }}?</p>
                                                      </div>
                                                      <div class="modal-footer justify-content-between">
                                                         <button type="button" class="btn btn-outline-dark"
                                                            data-dismiss="modal">Batal</button>
                                                         <form method="POST" action="/pekerja/{{ $s->id }}">
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
                                          @endcan
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
         $("#data_staf_lain").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                  extend: 'copy',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                  }
               },
               {
                  extend: 'excel',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                  }
               },
               {
                  extend: 'pdf',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                  }
               },
               {
                  extend: 'print',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                  }
               }
            ]
         }).buttons().container().appendTo('#data_staf_lain_wrapper .col-md-6:eq(0)');
      });
   </script>
@endsection
