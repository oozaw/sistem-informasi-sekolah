@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Kelas</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item active">Data Kelas</li>
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
                           <a href="/kelas/create" class="btn btn-success btn-sm mr-1">
                              <i class="fas fa-file-plus"></i> Tambah Kelas</a>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="table_kelas" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Kelas</th>
                                 <th>Siswa</th>
                                 <th>Wali Kelas</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>10 MIA 2</td>
                                 <td>25</td>
                                 <td>Gunawan Cahyadi</td>
                                 <td>
                                    <div class="d-inline-flex">
                                       <a href="" class="btn btn-info btn-sm mr-1">
                                          <i class="fas fa-eye"></i> Detail</a>
                                       <a href="" class="btn btn-primary btn-sm mr-1">
                                          <i class="fas fa-edit"></i> Edit</a>
                                       <a href="" class="btn btn-danger btn-sm mr-1">
                                          <i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>11 MIA 2</td>
                                 <td>30</td>
                                 <td>Febrianto Kurniawane</td>
                                 <td>
                                    <div class="d-inline-flex">
                                       <a href="" class="btn btn-info btn-sm mr-1">
                                          <i class="fas fa-eye"></i> Detail</a>
                                       <a href="" class="btn btn-primary btn-sm mr-1">
                                          <i class="fas fa-edit"></i> Edit</a>
                                       <a href="" class="btn btn-danger btn-sm mr-1">
                                          <i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                 </td>
                              </tr>
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
         $("#table_kelas").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
         }).buttons().container().appendTo('#table_kelas_wrapper .col-md-6:eq(0)');
      });
   </script>
@endsection
