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
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item active">Data Kepala Sekolah</li>
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
                        <h3 class="widget-user-username"><b>{{ $kepsek->nama }}</b></h3>
                     </div>
                     <div class="widget-user-image">
                        @if ($kepsek->foto_profil)
                           <img class="img-circle elevation-2" style="width: 90px; height: 90px; object-position: center"
                              src="/storage/{{ $kepsek->foto_profil }}" alt="Foto profil siswa">
                        @else
                           <div class="img-circle bg-secondary elevation-1">
                              <i class="fas fa-user-circle fa-6x"></i>
                           </div>
                        @endif
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">{{ $kepsek->jabatan }}</h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-8">
                              <p class="text-muted text-center">{{ $kepsek->email }}</p>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mt-1 mb-2">
                           @can('admin')
                              <div class="col-6">
                                 <a href="/kepala-sekolah-edit" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
                              </div>
                           @endcan
                        </div>
                     </div>
                     <!-- /.widget-user -->
                  </div>
               </div>
               <!-- /.col -->
               <div class="col-md-8">
                  <div class="card card-outline card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Data Kepala Sekolah</h3>
                        <div class="d-inline-flex"></div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $kepsek->nama }}</p>
                        <hr>
                        <strong><i class="far fa-venus-mars"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $kepsek->gender }}</p>
                        <hr>
                        <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $kepsek->email }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $kepsek->nip }}</p>
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No. Telepon</strong>
                        <p class="text-muted">{{ $kepsek->no_hp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $kepsek->tempat_tinggal }}</p>
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
   <script></script>
@endsection
