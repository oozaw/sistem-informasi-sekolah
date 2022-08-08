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
                  <h1>Siswa Bebas Komite</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item">Pembayaran Komite</li>
                     <li class="breadcrumb-item active">Bebas Komite</li>
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
                           <a href="/komite" class="btn btn-secondary btn-sm mr-1">
                              <i class="fas fa-long-arrow-left"></i> Kembali</a>
                           <a href="" class="btn btn-success btn-sm mr-1" data-toggle="modal"
                              data-target="#modal-tambah">
                              <i class="fas fa-user-plus"></i> Tambah Siswa Penerima</a>
                           <!-- Modal Add -->
                           <div class="modal fade" id="modal-tambah" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Tambah Siswa Penerima</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <form method="POST" action="/update-bebas-komite">
                                          @method('put')
                                          @csrf
                                          <div class="col">
                                             <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="form-control @error('kelas_id') is-invalid @enderror"
                                                   name="kelas_id" id="kelas_id">
                                                   <option selected disabled hidden value="">-- Pilih kelas --
                                                   </option>
                                                   @foreach ($kelas as $k)
                                                      @if (old('kelas_id') == $k->id)
                                                         <option value="{{ $k->id }}" selected>
                                                            {{ $k->nama }}</option>
                                                      @else
                                                         <option value="{{ $k->id }}">{{ $k->nama }}
                                                         </option>
                                                      @endif
                                                   @endforeach
                                                </select>
                                                @error('kelas_id')
                                                   <div class="invalid-feedback">
                                                      {{ $message }}
                                                   </div>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="col">
                                             <div class="form-group">
                                                <label for="siswa_id">Nama</label>
                                                <select class="form-control @error('siswa_id') is-invalid @enderror"
                                                   name="siswa_id" id="siswa_id">
                                                   <option value="" disabled hidden selected>-- Pilih siswa --
                                                   </option>
                                                </select>
                                                @error('siswa_id')
                                                   <div class="invalid-feedback">
                                                      {{ $message }}
                                                   </div>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="col">
                                             <label class="mb-0">Rentang Bebas Komite</label>
                                             <div class="form-group">
                                                <div class="row">
                                                   <div class="col-6 pl-4">
                                                      <label for="bebas1">Semester 1</label>
                                                      <div class="row">
                                                         <div class="col-sm-4">
                                                            <input
                                                               class="form-control @error('bebas1') is-invalid @enderror"
                                                               type="number" name="bebas1" id="bebas1" min="0"
                                                               max="6" value="0">
                                                         </div>
                                                         <div class="col-sm-3">
                                                            <span>
                                                               <p class="col-form-label">bulan</p>
                                                            </span>
                                                         </div>
                                                      </div>
                                                      @error('bebas1')
                                                         <div class="invalid-feedback">
                                                            {{ $message }}
                                                         </div>
                                                      @enderror
                                                   </div>
                                                   <div class="col-6 pl-4">
                                                      <label for="bebas2">Semester 2</label>
                                                      <div class="row">
                                                         <div class="col-sm-4">
                                                            <input
                                                               class="form-control @error('bebas2') is-invalid @enderror"
                                                               type="number" name="bebas2" id="bebas2" min="0"
                                                               max="6" value="0">
                                                         </div>
                                                         <div class="col-sm-3">
                                                            <span>
                                                               <p class="col-form-label">bulan</p>
                                                            </span>
                                                         </div>
                                                      </div>
                                                      @error('bebas2')
                                                         <div class="invalid-feedback">
                                                            {{ $message }}
                                                         </div>
                                                      @enderror
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <button type="button" class="btn btn-outline-dark"
                                          data-dismiss="modal">Batal</button>
                                       <button onclick="return true" class="btn btn-success">Tambah</button>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                           </div>
                           <!-- /.modal -->
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="table_bebas_komite" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th class="text-center align-middle" rowspan="2">No.</th>
                                 <th class="text-center align-middle" rowspan="2">Nama</th>
                                 <th class="text-center align-middle" rowspan="2">Kelas</th>
                                 <th class="text-center" colspan="2">Rentang</th>
                                 <th class="text-center align-middle" rowspan="2">Aksi</th>
                              </tr>
                              <tr>
                                 <th class="text-center align-middle">Sem. 1</th>
                                 <th class="text-center align-middle">Sem. 2</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($komite as $ko)
                                 <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $ko->siswa->nama }}</td>
                                    <td class="text-center align-middle">{{ $ko->siswa->kelas->nama }}</td>
                                    <td class="text-center align-middle">{{ $ko->bebas1 }} bulan
                                    </td>
                                    <td class="text-center align-middle">{{ $ko->bebas2 }} bulan
                                    </td>
                                    <td class="text-center">
                                       <div class="d-inline-flex">
                                          <a href="" class="btn btn-primary btn-sm mr-1" data-toggle="modal"
                                             data-target="#modal-edit-{{ $ko->id }}">
                                             <i class="fas fa-edit"></i> Edit</a>
                                          <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                             data-target="#modal-delete-{{ $ko->id }}">
                                             <i class="fas fa-trash"></i> Hapus</a>
                                       </div>
                                    </td>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modal-edit-{{ $ko->id }}" style="display: none;"
                                       aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 class="modal-title">Edit Beasiswa</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form method="POST" action="/update-bebas-komite">
                                                   @method('put')
                                                   @csrf
                                                   <div class="col">
                                                      <div class="form-group">
                                                         <label>Kelas</label>
                                                         <select
                                                            class="form-control @error('kelas_id') is-invalid @enderror"
                                                            disabled>
                                                            <option value="{{ $ko->siswa->kelas->id }}" selected>
                                                               {{ $ko->siswa->kelas->nama }}
                                                            </option>
                                                         </select>
                                                         <input type="text" name="kelas_id" id="kelas_id"
                                                            value="{{ $ko->siswa->kelas->id }}" readonly hidden>
                                                         @error('kelas_id')
                                                            <div class="invalid-feedback">
                                                               {{ $message }}
                                                            </div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <div class="col">
                                                      <div class="form-group">
                                                         <label for="siswa_id">Nama</label>
                                                         <select
                                                            class="form-control @error('siswa_id') is-invalid @enderror"
                                                            disabled>
                                                            <option value="{{ $ko->siswa->id }}" selected>
                                                               {{ $ko->siswa->nama }}
                                                            </option>
                                                         </select>
                                                         <input type="text" name="siswa_id" id="siswa_id"
                                                            value="{{ $ko->siswa->id }}" readonly hidden>
                                                         @error('siswa_id')
                                                            <div class="invalid-feedback">
                                                               {{ $message }}
                                                            </div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <div class="col">
                                                      <label class="mb-0">Rentang Bebas Komite</label>
                                                      <div class="form-group">
                                                         <div class="row">
                                                            <div class="col-6 pl-4">
                                                               <label for="bebas1">Semester 1</label>
                                                               <div class="row">
                                                                  <div class="col-sm-4">
                                                                     <input
                                                                        class="form-control @error('bebas1') is-invalid @enderror"
                                                                        type="number" name="bebas1" id="bebas1"
                                                                        min="0" max="6"
                                                                        value="{{ $ko->bebas1 }}">
                                                                  </div>
                                                                  <div class="col-sm-3">
                                                                     <span>
                                                                        <p class="col-form-label">bulan</p>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               @error('bebas1')
                                                                  <div class="invalid-feedback">
                                                                     {{ $message }}
                                                                  </div>
                                                               @enderror
                                                            </div>
                                                            <div class="col-6 pl-4">
                                                               <label for="bebas2">Semester 2</label>
                                                               <div class="row">
                                                                  <div class="col-sm-4">
                                                                     <input
                                                                        class="form-control @error('bebas2') is-invalid @enderror"
                                                                        type="number" name="bebas2" id="bebas2"
                                                                        min="0" max="6"
                                                                        value="{{ $ko->bebas2 }}">
                                                                  </div>
                                                                  <div class="col-sm-3">
                                                                     <span>
                                                                        <p class="col-form-label">bulan</p>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               @error('bebas2')
                                                                  <div class="invalid-feedback">
                                                                     {{ $message }}
                                                                  </div>
                                                               @enderror
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark"
                                                   data-dismiss="modal">Batal</button>
                                                <button onclick="return true" class="btn btn-primary">Simpan</button>
                                                </form>
                                             </div>
                                          </div>
                                          <!-- /.modal-content -->
                                       </div>
                                       <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="modal-delete-{{ $ko->id }}"
                                       style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Beasiswa</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form method="POST" action="/update-bebas-komite">
                                                   @method('put')
                                                   @csrf
                                                   <input type="number" name="siswa_id" id="siswa_id"
                                                      value="{{ $ko->siswa->id }}" hidden>
                                                   <input type="number" name="bebas1" id="bebas1" value="0"
                                                      hidden>
                                                   <input type="number" name="bebas2" id="bebas2" value="0"
                                                      hidden>
                                                   <p>Yakin hapus beasiswa {{ $ko->siswa->nama }}?</p>
                                             </div>
                                             <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark"
                                                   data-dismiss="modal">Batal</button>
                                                <button onclick="return true" class="btn btn-danger">Hapus</button>
                                                </form>
                                             </div>
                                          </div>
                                          <!-- /.modal-content -->
                                       </div>
                                       <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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
         $("#kelas_id").on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('get-data-siswa') }}",
               method: 'post',
               data: {
                  kelas_id: $("#kelas_id").val()
               },
               beforeSend: function() {
                  $("#siswa_id").html(
                     '<option value="" disabled hidden selected>-- Pilih siswa -- </option>');
               },
               success: function(result) {
                  $("#siswa_id").append(result);
               }
            });
         });
      });

      $(function() {
         $("#table_bebas_komite").DataTable({
            "responsive": false,
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
                  customize: function(doc) {
                     doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  },
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
         }).buttons().container().appendTo('#table_bebas_komite_wrapper .col-md-6:eq(0)');
      });
   </script>
@endsection
