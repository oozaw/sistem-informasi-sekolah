@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="d-inline-flex">
                  @if (session()->has('success'))
                     <div class="successAlert" hidden>{{ session('success') }}</div>
                  @endif
                  @if (session()->has('fail'))
                     <div class="failAlert" hidden>{{ session('fail') }}</div>
                  @endif
               </div>
               <div class="col-sm-6">
                  <h1>{{ $title }}</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item active">Tahun Pelajaran {{ $ta->status == '1' ? 'Aktif' : '' }}</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="card card-outline card-primary">
               <div class="card-header">
                  <h3 class="card-title">Data Tahun Pelajaran</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body pb-1">
                  <div class="row">
                     <div class="col-md-4 text-center mt-4">
                        <h4>Tahun Pelajaran</h4>
                        <h1>{{ $ta->tahun_ajaran }}</h1>
                        <span class="box {{ $ta->status == '1' ? 'bg-green' : 'bg-gray' }} btn-sm d-block col-3 m-auto">
                           {{ $ta->status == '1' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                        <div class="mt-5 text-center">
                           <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm mb-1">
                              <i class="fas fa-long-arrow-left mr-1"></i> Kembali</a>
                           <a href="/tahun-ajaran/{{ $ta->id }}/edit" class="btn btn-primary btn-sm mb-1">
                              <i class="fas fa-edit mr-1"></i> Edit</a>
                           @if ($ta->status == '0')
                              <a href="" class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                 data-target="#modal-delete-{{ $ta->id }}">
                                 <i class="fas fa-trash mr-1"></i> Hapus</a>

                              <!-- Modal Delete-->
                              <div class="modal fade" id="modal-delete-{{ $ta->id }}" style="display: none;"
                                 aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content bg-warning">
                                       <div class="modal-header">
                                          <h4 class="modal-title">Hapus Data Tahun Pelajaran</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p>Yakin hapus data tahun pelajaran {{ $ta->nama }}?</p>
                                       </div>
                                       <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-dark"
                                             data-dismiss="modal">Batal</button>
                                          <form method="POST" action="/tahun-ajaran/{{ $ta->id }}">
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
                              <!-- /.modal delete -->
                           @endif
                           <br>
                           <a href="/tahun-ajaran" class="btn btn-info btn-sm">
                              <i class="fas fa-layer-group mr-1"></i> List Tahun Pelajaran</a>
                           <a href="/tahun-ajaran/create" class="btn btn-success btn-sm">
                              <i class="fas fa-layer-plus mr-1"></i> Tahun Pelajaran Baru</a>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-sm-6 border-right mr-0">
                              <strong><i class="fad fa-users-class mr-1"></i> Jumlah Keseluruhan Siswa</strong>
                              <p class="text-muted mb-0">{{ $ta->jml_siswa }}</p>
                           </div>
                           <div class="col-sm-6">
                              <strong class="ml-2"><i class="fad fa-user-plus mr-1"></i> Jumlah Siswa Baru</strong>
                              <p class="text-muted mb-0 ml-2">{{ $ta->jml_siswa_baru }}</p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-6 border-right mr-0">
                              <strong><i class="fad fa-user-graduate mr-1"></i> Jumlah Siswa Lulus</strong>
                              <p class="text-muted mb-0">{{ $ta->jml_siswa_lulus }}</p>
                           </div>
                           <div class="col-sm-6">
                              <strong class="ml-2"><i class="fad fa-user-minus mr-1"></i> Jumlah Siswa
                                 Keluar/Pindah</strong>
                              <p class="text-muted mb-0 ml-2">{{ $ta->jml_siswa_keluar }}</p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-6 border-right mr-0">
                              <strong><i class="fas fa-medal mr-1"></i> Jumlah Prestasi</strong>
                              <p class="text-muted mb-0">{{ $ta->jml_prestasi }}</p>
                           </div>
                           <div class="col-sm-6">
                              <strong class="ml-2"><i class="fad fa-user-cog mr-1"></i> Jumlah Pegawai</strong>
                              <p class="text-muted mb-0 ml-2">{{ $ta->jml_pegawai }}</p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-6 border-right mr-0">
                              <strong><i class="fad fa-inbox-in mr-1"></i> Jumlah Surat Masuk</strong>
                              <p class="text-muted mb-0">{{ $ta->jml_surat_masuk }}</p>
                           </div>
                           <div class="col-sm-6">
                              <strong class="ml-2"><i class="fad fa-inbox-out mr-1"></i></i> Jumlah Surat Keluar</strong>
                              <p class="text-muted mb-0 ml-2">{{ $ta->jml_surat_keluar }}</p>
                           </div>
                        </div>
                        <hr>
                     </div>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.card-body -->
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
