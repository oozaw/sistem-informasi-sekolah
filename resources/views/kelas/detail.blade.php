@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Siswa</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item active">Data Siswa</li>
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
                  <div class="card card-info">
                     <div class="card-header">
                        <h4 class="mb-0">Kelas {{ $kelas->nama }}</h4>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_siswa" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Nama</th>
                                 <th>NIS</th>
                                 <th>Jenis Kelamin</th>
                                 <th>Kelas</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($siswa as $s)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->gender }}</td>
                                    <td>
                                       @if ($s->kelas)
                                          {{ $s->kelas->nama }}
                                       @else
                                          -
                                       @endif
                                    </td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/siswa/{{ $s->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Detail</a>
                                          <a href="/siswa/{{ $s->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                             <i class="fas fa-edit"></i> Edit</a>
                                          <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                             data-target="#modal-delete-{{ $s->id }}">
                                             <i class="fas fa-trash"></i> Hapus</a>

                                          <!-- Modal -->
                                          <div class="modal fade" id="modal-delete-{{ $s->id }}"
                                             style="display: none;" aria-hidden="true">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h4 class="modal-title">Hapus Data Kelas</h4>
                                                      <button type="button" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <span aria-hidden="true">×</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <p>Yakin hapus data kelas {{ $s->nama }}?</p>
                                                   </div>
                                                   <div class="modal-footer justify-content-between">
                                                      <button type="button" class="btn btn-default"
                                                         data-dismiss="modal">Batal</button>
                                                      <form method="POST" action="/siswa/{{ $s->id }}">
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
         $("#data_siswa").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
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
         }).buttons().container().appendTo('#data_siswa_wrapper .col-md-6:eq(0)');
      });
   </script>
@endsection
