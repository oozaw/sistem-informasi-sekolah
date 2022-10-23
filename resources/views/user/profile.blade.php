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
                     <li class="breadcrumb-item active">Profil</li>
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
               <div class="col-md-4">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">{{ $user->pegawai->nama }}</h3>
                     </div>
                     <div class="widget-user-image">
                        @if ($user->pegawai && $user->pegawai->foto_profil)
                           <img class="img-circle elevation-2"
                              style="width: 90px; height: 90px; object-fit: cover; object-position: center"
                              src="/storage/{{ $user->pegawai->foto_profil }}" alt="Foto profil pengguna">
                        @else
                           <div class="img-circle bg-secondary elevation-1">
                              <i class="fas fa-user-circle fa-6x"></i>
                           </div>
                        @endif
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">{{ $user->pegawai->jabatan }}</h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-8">
                              <p class="text-muted text-center">{{ $user->pegawai->email }}</p>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mt-1 mb-2">
                           {{-- @can('admin')
                              <div class="col-6">
                                 <a href="/" class="btn btn-warning btn-block"><b>Edit Profil</b></a>
                              </div>
                           @endcan --}}
                        </div>
                     </div>
                     <!-- /.widget-user -->
                  </div>
               </div>
               <!-- /.col -->
               <div class="col-md-8">
                  <div class="card card-outline card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Profil Saya</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-user-edit mr-1"></i> Tipe Pengguna</strong>
                        <p class="text-muted">
                           @if ($user->role == 1)
                              {{ 'Administrator' }}
                           @elseif ($user->role == 2)
                              {{ 'Guru' }}
                           @elseif ($user->role == 4)
                              {{ 'Kepala Sekolah' }}
                           @else
                              {{ 'Tata Usaha' }}
                           @endif
                        </p>
                        <hr>
                        <strong><i class="fas fa-hashtag mr-1"></i> Nama Pengguna</strong>
                        <p class="text-muted">{{ $user->username }}</p>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $user->pegawai->nama }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $user->role == '1' ? '-' : $user->pegawai->nip }}</p>
                        <hr>
                        <strong><i class="far fa-venus-mars"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $user->pegawai->gender }}</p>
                        <hr>
                        <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $user->pegawai->email }}</p>
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No. Telepon</strong>
                        <p class="text-muted">{{ $user->pegawai->no_hp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $user->pegawai->tempat_tinggal }}</p>
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
@endsection
