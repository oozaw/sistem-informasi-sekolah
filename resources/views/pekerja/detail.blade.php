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
                     <li class="breadcrumb-item">Kepegawaian</li>
                     <li class="breadcrumb-item">Data Pegawai</li>
                     <li class="breadcrumb-item active">Detail Pegawai</li>
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
                        <h3 class="widget-user-username">{{ $pekerja->nama }}</h3>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="/img/profil-me.png" alt="User Avatar">
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">{{ $pekerja->jabatan }}</h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <p class="text-muted text-center">
                                 {{ $pekerja->email }}
                              </p>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mt-3 mb-2">
                           <div class="col-6">
                              <a href="/pekerja/{{ $pekerja->id }}/edit" class="btn btn-warning btn-block"><b>Edit
                                    Data</b></a>
                           </div>
                        </div>
                     </div>
                     <!-- /.widget-user -->
                  </div>
               </div>
               <!-- /.col -->
               <div class="col-md-8">
                  <div class="card card-outline card-info">
                     <div class="card-header">
                        <h3 class="card-title">Data Pegawai</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $pekerja->nama }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $pekerja->nip }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> No. Handphone</strong>
                        <p class="text-muted">{{ $pekerja->no_hp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Tinggal</strong>
                        <p class="text-muted">{{ $pekerja->tempat_tinggal }}</p>
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
