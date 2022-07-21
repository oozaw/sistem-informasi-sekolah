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
                     <li class="breadcrumb-item">Siswa</li>
                     <li class="breadcrumb-item active">Detail Siswa</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-4">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $siswa->nama }}</h3>
                     </div>
                     <div class="widget-user-image">
                        @if ($siswa->foto_profil)
                           <img class="img-circle elevation-2"
                              style="width: 90px; height: 90px; object-fit: cover; object-position: center"
                              src="/storage/{{ $siswa->foto_profil }}" alt="Foto profil siswa">
                        @else
                           <div class="img-circle bg-secondary elevation-1">
                              <i class="fas fa-user-circle fa-6x"></i>
                           </div>
                        @endif
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">Siswa</h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="text-muted text-center">
                                 {{ $siswa->kelas->nama }}
                              </h4>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mb-2 mt-2">
                           <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm mr-1">
                              <i class="fas fa-long-arrow-left"></i> Kembali</a>
                           <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-primary btn-sm mr-1">
                              <i class="fas fa-edit"></i> Edit Profil</a>
                           <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                              data-target="#modal-delete-{{ $siswa->id }}">
                              <i class="fas fa-trash"></i> Hapus</a>
                           <!-- Modal -->
                           <div class="modal fade" id="modal-delete-{{ $siswa->id }}" style="display: none;"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content bg-warning">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Hapus Data Siswa</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Yakin hapus data siswa {{ $siswa->nama }}?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <button type="button" class="btn btn-outline-dark"
                                          data-dismiss="modal">Batal</button>
                                       <form method="POST" action="/siswa/{{ $siswa->id }}">
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
                     </div>
                     <!-- /.widget-user -->
                  </div>
               </div>
               <!-- /.col -->
               <div class="col-md-8">
                  <div class="card card-outline card-info">
                     <div class="card-header">
                        <h3 class="card-title">Data Diri</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $siswa->nama }}</p>
                        <hr>
                        <strong><i class="far fa-venus-mars"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $siswa->gender }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIS</strong>
                        <p class="text-muted">{{ $siswa->nis }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NISN</strong>
                        <p class="text-muted">{{ $siswa->nisn }}</p>
                        <hr>
                        <strong><i class="fas fa-medal mr-1"></i> Prestasi</strong>
                        @if ($prestasi->count() == 0)
                           <p class="text-muted">-</p>
                        @else
                           @foreach ($prestasi as $p)
                              <p class="text-muted mb-0">{{ $p->capaian }} - {{ $p->nama }} {{ $p->tahun }}
                              </p>
                           @endforeach
                        @endif
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No. Telepon</strong>
                        <p class="text-muted">{{ $siswa->no_telp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $siswa->tempat_tinggal }}</p>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
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
