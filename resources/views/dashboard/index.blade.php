@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Dashboard</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3>{{ $jumlah_kelas }}</h3>

                        <p>Kelas</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                     </div>
                     <a href="/kelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ $jumlah_siswa }}</h3>

                        <p>Siswa</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-users"></i>
                     </div>
                     <a href="/siswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                     <div class="inner text-light">
                        <h3>30</h3>

                        <p>Guru</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                     </div>
                     <a href="#" class="small-box-footer" style="color: #FFFFFF !important;">More info <i
                           class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                     <div class="inner">
                        <h3>8</h3>

                        <p>Staf Tata Usaha</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-users-cog"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-secondary">
                     <div class="inner">
                        <h3>8</h3>

                        <p>Tenaga Kerja Lain</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-user-friends"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-maroon">
                     <div class="inner">
                        <h3>8</h3>

                        <p>Surat Masuk</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-inbox-in"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                     <div class="inner">
                        <h3>8</h3>

                        <p>Surat Keluar</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-inbox-out"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-primary">
                     <div class="inner">
                        <h3>8</h3>

                        <p>Surat Keluar</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-users-cog"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
            </div>
         </div>

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
