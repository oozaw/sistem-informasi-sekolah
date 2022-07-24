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
                     <li class="breadcrumb-item">Data Pengguna</li>
                     <li class="breadcrumb-item active">Detail Pengguna</li>
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
                        <h3 class="widget-user-username">{{ $pengguna->username }}</h3>
                     </div>
                     <div class="widget-user-image">
                        @if ($profil && $profil->foto_profil)
                           <img class="img-circle elevation-2"
                              style="width: 90px; height: 90px; object-fit: cover; object-position: center"
                              src="/storage/{{ $profil->foto_profil }}" alt="Foto profil pekerja">
                        @else
                           <div class="img-circle bg-secondary elevation-1">
                              <i class="fas fa-user-circle fa-6x"></i>
                           </div>
                        @endif
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">
                                 @if ($pengguna->role == 1)
                                    {{ 'Admin' }}
                                 @elseif ($pengguna->role == 2)
                                    {{ 'Guru' }}
                                 @elseif ($pengguna->role == 4)
                                    {{ 'Kepala Sekolah' }}
                                 @else
                                    {{ 'Tata Usaha' }}
                                 @endif
                              </h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <p class="text-muted text-center">
                                 @if (Cache::has('user-is-online-' . $pengguna->id))
                                    <span class="box bg-green btn-xs d-block text-center col-6 m-auto">Online</span>
                                 @else
                                    <span class="box bg-gray btn-xs d-block text-center col-6 m-auto">Offline</span>
                                 @endif
                                 <small>
                                    {{ \Carbon\Carbon::parse($pengguna->last_seen)->diffForHumans() }}
                                 </small>
                              </p>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mb-2 mt-0">
                           <a href="/pengguna" class="btn btn-secondary btn-sm mr-1">
                              <i class="fas fa-long-arrow-left"></i> Kembali</a>
                           <a href="/pengguna/{{ $pengguna->id }}/edit" class="btn btn-primary btn-sm mr-1"
                              {{ $pengguna->role == '1' ? 'hidden' : '' }}>
                              <i class="fas fa-edit"></i> Edit Profil</a>
                           <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                              data-target="#modal-delete-{{ $pengguna->id }}"
                              {{ $pengguna->role == '1' ? 'hidden' : '' }}>
                              <i class="fas fa-trash"></i> Hapus</a>
                           <!-- Modal -->
                           <div class="modal fade" id="modal-delete-{{ $pengguna->id }}" style="display: none;"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content bg-warning">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Hapus Data Pengguna</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Yakin hapus Data Pengguna {{ $pengguna->nama }}?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <button type="button" class="btn btn-outline-dark"
                                          data-dismiss="modal">Batal</button>
                                       <form method="POST" action="/pengguna/{{ $pengguna->id }}">
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
                        <h3 class="card-title">Data Pengguna</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-hashtag mr-1"></i> Username</strong>
                        <p class="text-muted">{{ $pengguna->username }}</p>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? 'Admin' : $profil->nama }}</p>
                        <hr>
                        <strong><i class="fas fa-key"></i> Password</strong>
                        <p class="text-muted">{{ decrypt($pengguna->dec_password) }}</p>
                        <hr>
                        <strong><i class="far fa-venus-mars"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->gender }}</p>
                        <hr>
                        <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->email }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->nip }}</p>
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No. Telepon</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->no_hp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Tinggal</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->tempat_tinggal }}</p>
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
