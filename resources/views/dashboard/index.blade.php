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
                        <h3>{{ $jumlah_guru }}</h3>

                        <p>Guru</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                     </div>
                     <a href="/guru" class="small-box-footer" style="color: #FFFFFF !important;">More info <i
                           class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                     <div class="inner">
                        <h3>{{ $jumlah_tu }}</h3>

                        <p>Staf Tata Usaha</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-users-cog"></i>
                     </div>
                     <a href="/tata-usaha" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-secondary">
                     <div class="inner">
                        <h3>{{ $jumlah_staf_lain }}</h3>

                        <p>Staf Lain</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-user-friends"></i>
                     </div>
                     <a href="/staf-lain" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-maroon">
                     <div class="inner">
                        <h3>{{ $jumlah_surat_masuk }}</h3>

                        <p>Surat Masuk</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-inbox-in"></i>
                     </div>
                     <a href="/surat-masuk" class="small-box-footer">More info <i
                           class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                     <div class="inner">
                        <h3>{{ $jumlah_surat_keluar }}</h3>

                        <p>Surat Keluar</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-inbox-out"></i>
                     </div>
                     <a href="/surat-keluar" class="small-box-footer">More info <i
                           class="fas fa-arrow-circle-right"></i></a>
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
               <div class="col-md-6">
                  <div class="card card-success">
                     <div class="card-header">
                        <h3 class="card-title">Siswa Chart</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                           </button>
                        </div>
                     </div>
                     <div class="card-data" style="display: none">
                        <div id="laki-laki">{{ $jumlah_laki }}</div>
                        <div id="perempuan">{{ $jumlah_perempuan }}</div>
                     </div>
                     <div class="card-body">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <canvas id="siswaChart"
                           style="min-height: 200px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 422px;"
                           width="844" height="500" class="chartjs-render-monitor"></canvas>
                        <p class="text-center mt-3">Jumlah Keseluruhan Siswa: {{ $jumlah_siswa }}</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card card-warning">
                     <div class="card-header">
                        <h3 class="card-title">Pegawai Chart</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                           </button>
                        </div>
                     </div>
                     <div class="card-data" style="display: none">
                        <div id="guru">{{ $jumlah_guru }}</div>
                        <div id="tu">{{ $jumlah_tu }}</div>
                        <div id="staf-lain">{{ $jumlah_staf_lain }}</div>
                     </div>
                     <div class="card-body">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <canvas id="pegawaiChart"
                           style="min-height: 200px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 422px;"
                           width="844" height="500" class="chartjs-render-monitor"></canvas>
                        <p class="text-center mt-3">Jumlah Keseluruhan Pegawai:
                           {{ $jumlah_guru + $jumlah_tu + $jumlah_staf_lain }}</p>
                     </div>
                  </div>
               </div>
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
   <!-- Chart JS -->
   <script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <script>
      $(function() {
         /* ChartJS
          * -------
          * Here we will create a few charts using ChartJS
          */

         //-------------
         //- SISWA DONUT CHART -
         //-------------
         // Get context with jQuery - using jQuery's .get() method.
         var siswaChartCanvas = $('#siswaChart').get(0).getContext('2d')
         var donutData = {
            labels: [
               "Laki-laki",
               "Perempuan"
            ],
            datasets: [{
               data: [$("#laki-laki").text(), $("#perempuan").text()],
               backgroundColor: ['#093eeb', '#09de33'],
            }]
         }
         var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
         }
         //Create pie or douhnut chart
         // You can switch between pie and douhnut using the method below.
         new Chart(siswaChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
         })

         //-------------
         //- PEGAWAI DONUT CHART -
         //-------------
         // Get context with jQuery - using jQuery's .get() method.
         var pegawaiChartCanvas = $('#pegawaiChart').get(0).getContext('2d')
         var donutData = {
            labels: [
               "Guru",
               "Staf Tata Usaha",
               "Staf Lain"
            ],
            datasets: [{
               data: [$("#guru").text(), $("#tu").text(), $("#staf-lain").text()],
               backgroundColor: ['#d96d0f', '#5411ab', '#bf1111'],
            }]
         }
         var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
         }
         //Create pie or douhnut chart
         // You can switch between pie and douhnut using the method below.
         new Chart(pegawaiChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
         })
      })
   </script>
@endsection
