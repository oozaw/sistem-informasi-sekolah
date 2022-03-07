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
                        {{-- <img class="img-circle elevation-2" src="/img/profil-me.png" alt="User Avatar"> --}}
                        <div class="img-circle bg-secondary elevation-1">
                           <i class="fas fa-user-circle fa-6x"></i>
                        </div>
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
                        <div class="d-flex justify-content-center mt-3 mb-2">
                           <div class="col-6">
                              <a href="#" class="btn btn-warning btn-block"><b>Edit Profil</b></a>
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
                        <h3 class="card-title">Data Diri</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $siswa->nama }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $siswa->gender }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIS</strong>
                        <p class="text-muted">{{ $siswa->nis }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NISN</strong>
                        <p class="text-muted">{{ $siswa->nisn }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Tinggal</strong>
                        <p class="text-muted">Malibu, California</p>
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
