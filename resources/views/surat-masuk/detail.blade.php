@extends('layouts.main')

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
                     <li class="breadcrumb-item">Surat Masuk</li>
                     <li class="breadcrumb-item active">Detail Surat</li>
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
                        <div class="d-inline-flex">
                           @if (session()->has('success'))
                              <div class="successAlert" hidden>{{ session('success') }}</div>
                           @endif
                           @if (session()->has('fail'))
                              <div class="failAlert" hidden>{{ session('fail') }}</div>
                           @endif
                        </div>
                        <div class="d-inline-flex">
                           <h4 class="m-0">Detail Surat {{ $sm->asal }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="d-inline-flex mb-3 ml-2">
                              <a href="/surat-masuk" class="btn btn-secondary btn-sm mr-1">
                                 <i class="fas fa-long-arrow-left"></i> Kembali</a>
                              <a href="/surat-masuk/{{ $sm->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                 <i class="fas fa-edit"></i> Edit</a>
                              <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                 data-target="#modal-delete-{{ $sm->id }}">
                                 <i class="fas fa-trash"></i> Hapus</a>
                              <!-- Modal -->
                              <div class="modal fade" id="modal-delete-{{ $sm->id }}" style="display: none;"
                                 aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content bg-warning">
                                       <div class="modal-header">
                                          <h4 class="modal-title">Hapus Data Surat</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                             <button onclick="return true" class="btn btn-danger">Hapus</button>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- /.modal-content -->
                                 </div>
                                 <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
                           </div>
                           <table class="table">
                              <tbody>
                                 <tr>
                                    <th style="width: 20%">Pengirim</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{ $sm->asal }}</td>
                                 </tr>
                                 <tr>
                                    <th>No. Surat</th>
                                    <th>:</th>
                                    <td>{{ "$sm->nomor/$sm->kode_tujuan/$sm->instansi_asal/$sm->bulan-$sm->tahun" }}
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Tanggal Masuk</th>
                                    <th>:</th>
                                    <td>
                                       {{ \Carbon\Carbon::parse($sm->tgl_masuk)->isoFormat('D MMMM Y') }}
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <td>{{ $sm->keterangan }}</td>
                                 </tr>
                                 <tr>
                                    <th>Isi Surat</th>
                                    <th></th>
                                    <th></th>
                                 </tr>
                              </tbody>
                           </table>
                           <iframe class="col-md-12" height="800" src="/storage/{{ $sm->file_surat }}"
                              frameborder="0"></iframe>
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
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
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
