@extends('layouts.main')

@section('head')
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
                  <div class="small-box bg-purple">
                     <div class="inner">
                        <h3>{{ $kelas->count() }}</h3>

                        <p>Kelas</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                     </div>
                     <a href="/kelas" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ $siswa->count() }}</h3>

                        <p>Siswa</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-users"></i>
                     </div>
                     <a href="/siswa" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-primary">
                     <div class="inner">
                        <h3>{{ $prestasi->count() }}</h3>

                        <p>Prestasi</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-trophy"></i>
                     </div>
                     <a href="/prestasi" class="small-box-footer">Selengkapnya <i
                           class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               @cannot('guru')
                  <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box" style="background-color: #C52E3C">
                        <div class="inner text-light">
                           <h3>{{ $pekerjas->where('jabatan', 'Guru')->count() }}</h3>

                           <p>Guru</p>
                        </div>
                        <div class="icon">
                           <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="/guru" class="small-box-footer text-white" style="color: #FFFFFF !important;">Selengkapnya
                           <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box text-white" style="background-color: #AF2733">
                        <div class="inner">
                           <h3>{{ $pekerjas->where('jabatan', 'Staf Tata Usaha')->count() }}</h3>

                           <p>Staf Tata Usaha</p>
                        </div>
                        <div class="icon">
                           <i class="fas fa-users-cog"></i>
                        </div>
                        <a href="/tata-usaha" class="small-box-footer text-white">Selengkapnya <i
                              class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box text-white" style="background-color: #98202A">
                        <div class="inner">
                           <h3>{{ $pekerjas->where('jabatan', 'Staf Lainnya')->count() }}</h3>

                           <p>Staf Lain</p>
                        </div>
                        <div class="icon">
                           <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="/staf-lain" class="small-box-footer text-white">Selengkapnya <i
                              class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box" style="background-color: #F1E0C5">
                        <div class="inner">
                           <h3>{{ $surat_masuk->count() }}</h3>

                           <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                           <i class="fas fa-inbox-in"></i>
                        </div>
                        <a href="/surat-masuk" class="small-box-footer text-black" style="color: #000000">Selengkapnya <i
                              class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box" style="background-color: #17BEBB">
                        <div class="inner">
                           <h3>{{ $surat_keluar->count() }}</h3>

                           <p>Surat Keluar</p>
                        </div>
                        <div class="icon">
                           <i class="fas fa-inbox-out"></i>
                        </div>
                        <a href="/surat-keluar" class="small-box-footer" style="color: #000000">Selengkapnya <i
                              class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
               @endcannot
               <div class="col-md-6">
                  <div class="card card-success">
                     <div class="card-header">
                        <h3 class="card-title">Perbandingan Jumlah Siswa Laki-laki dan Perempuan</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                           </button>
                        </div>
                     </div>
                     <div class="card-data" style="display: none">
                        <div id="laki-laki">{{ $siswa->where('gender', 'Laki-laki')->count() }}</div>
                        <div id="perempuan">{{ $siswa->where('gender', 'Perempuan')->count() }}</div>
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
                        <p class="text-center mt-3">Jumlah Keseluruhan Siswa: {{ $siswa->count() }}</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header text-white" style="background-color: #C52E3C">
                        <h3 class="card-title">Perbandingan Jumlah Jabatan Pegawai</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                           </button>
                        </div>
                     </div>
                     <div class="card-data" style="display: none">
                        <div id="guru">{{ $pekerjas->where('jabatan', 'Guru')->count() }}</div>
                        <div id="tu">{{ $pekerjas->where('jabatan', 'Staf Tata Usaha')->count() }}</div>
                        <div id="staf-lain">{{ $pekerjas->where('jabatan', 'Staf Lainnya')->count() }}</div>
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
                           {{ $pekerjas->count() }}</p>
                     </div>
                  </div>
               </div>
               <div class="row col-md-12 my-3">
                  <label class="col-form-label pr-0 mx-2 mr-3 ml-4">Pilih rentang data:</label>
                  <div class="col-2 pl-0 mr-3">
                     <select class="form-control get-data" name="awal" id="awal" required>
                        @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->sortBy('tahun_ajaran') as $ta)
                           @if ($loop->first)
                              <option value="{{ $ta->tahun_ajaran }}" selected>{{ $ta->tahun_ajaran }}
                              </option>
                           @else
                              <option value="{{ $ta->tahun_ajaran }}">{{ $ta->tahun_ajaran }}
                              </option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <label class="col-form-label pr-0 mr-4">-</label>
                  <div class="col-2 pl-0 mr-3">
                     <select class="form-control get-data" name="akhir" id="akhir" required>
                        @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->sortBy('tahun_ajaran') as $ta)
                           @if ($loop->last)
                              <option value="{{ $ta->tahun_ajaran }}" selected>{{ $ta->tahun_ajaran }}
                              </option>
                           @else
                              <option value="{{ $ta->tahun_ajaran }}">{{ $ta->tahun_ajaran }}
                              </option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <label class="col-form-label align-text-bottom ">
                     <small class="col-2 text-danger">Maksimal rentang data 5 tahun</small>
                  </label>
               </div>
               <div id="initial_data" class="row">
                  <div class="col-md-6">
                     <div class="card bg-success">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title mt-1">
                              <i class="fas fa-chart-line mr-1"></i>
                              Grafik Jumlah Siswa Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
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
                           <canvas class="chart chartjs-render-monitor" id="jml-siswa-line-chart-initial"
                              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;"
                              width="1288" height="500"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     {{-- <div class="card" style="background-color: #12822E"> --}}
                     <div class="card bg-success">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title mt-1 text-white">
                              <i class="fas fa-chart-line mr-1"></i>
                              Grafik Jumlah Siswa Baru Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-sm bg-success" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
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
                           <canvas class="chart chartjs-render-monitor" id="jml-siswa-baru-line-chart-initial"
                              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;"
                              width="1288" height="500"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     {{-- <div class="card" style="background-color: #16C21C"> --}}
                     <div class="card bg-success">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title mt-1">
                              <i class="fas fa-chart-line mr-1"></i>
                              Grafik Jumlah Siswa Keluar/Pindah Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-sm bg-success" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
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
                           <canvas class="chart chartjs-render-monitor" id="jml-siswa-keluar-line-chart-initial"
                              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;"
                              width="1288" height="500"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card bg-primary">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title mt-1">
                              <i class="fas fa-chart-line mr-1"></i>
                              Grafik Jumlah Prestasi Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-sm bg-primary" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
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
                           <canvas class="chart chartjs-render-monitor" id="jml-prestasi-line-chart-initial"
                              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;"
                              width="1288" height="500"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card" style="background-color: #B10F2E ">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title mt-1 text-white">
                              <i class="fas fa-chart-line mr-1"></i>
                              Grafik Jumlah Pegawai Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-sm bg-red" data-card-widget="collapse"
                                 style="background-color: #B10F2E !important">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
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
                           <canvas class="chart chartjs-render-monitor" id="jml-pegawai-line-chart-initial"
                              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;"
                              width="1288" height="500"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card bg-dark">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                           <h3 class="card-title">
                              <i class="fas fa-chart-bar mr-1"></i>
                              Perbandingan Jumlah Surat Per Tahun Pelajaran
                           </h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-sm bg-dark" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                              </button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="chart">
                              <div class="chartjs-size-monitor">
                                 <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                 </div>
                                 <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                 </div>
                              </div>
                              <canvas class="chartjs-render-monitor" id="jml-surat-barChart-initial"
                                 style="min-height: 250px; height: 257px; max-height: 257px; max-width: 100%; display: block; width: 410px;"
                                 width="820" height="500"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="data" class="row"></div>
               <div id="loader"></div>
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
   <script>
      $(document).ready(function() {
         $("#data").hide();
         chart();
         $(".get-data").on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('chart-data') }}",
               method: 'post',
               data: {
                  awal: $("#awal").val(),
                  akhir: $("#akhir").val()
               },
               beforeSend: function() {
                  $("#initial_data").hide();
                  $("#data").text('');
               },
               success: function(result) {
                  if (result.status == 0) {
                     $("#initial_data").show();
                  } else {
                     $("#data").append(result);
                     $("#data").show();
                  }
               }
            });
         });
      });

      $(document).on({
         ajaxStart: function() {
            $("body").addClass("loading");
            $("#loader").addClass('overlay');
         },
         ajaxStop: function() {
            $("#loader").removeClass('overlay');
            $("body").removeClass("loading");
         }
      });

      function chart() {
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
               backgroundColor: ['#093eeb', '#E936A4'],
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

         //-------------
         //- JUMLAH SISWA LINE CHART -
         //-------------
         var jmlSiswaGraphChartInititalCanvas = $('#jml-siswa-line-chart-initial').get(0).getContext('2d')

         var jmlSiswaGraphChartInititalData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
               label: 'Jumlah Siswa',
               fill: true,
               borderWidth: 2,
               lineTension: 0,
               spanGaps: true,
               borderColor: '#efefef',
               pointRadius: 3,
               pointHoverRadius: 7,
               pointColor: '#efefef',
               pointBackgroundColor: '#efefef',
               data: [
                  @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                     {{ $ta->jml_siswa }},
                  @endforeach
               ]
            }]
         }

         var jmlSiswaGraphChartInititalOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
               display: false
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: false,
                     color: '#efefef',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Jumlah Siswa'
                  },
                  ticks: {
                     stepSize: 50,
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: true,
                     color: '#efefef',
                     drawBorder: false
                  }
               }]
            }
         }

         // This will get the first returned node in the jQuery collection.
         // eslint-disable-next-line no-unused-vars
         var jmlSiswaGraphChartInitital = new Chart(jmlSiswaGraphChartInititalCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: jmlSiswaGraphChartInititalData,
            options: jmlSiswaGraphChartInititalOptions
         })

         //-------------
         //- JUMLAH SISWA BARU LINE CHART -
         //-------------
         var jmlSiswaBaruGraphChartInititalCanvas = $('#jml-siswa-baru-line-chart-initial').get(0).getContext('2d')

         var jmlSiswaBaruGraphChartInititalData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
               label: 'Jumlah Siswa Baru',
               fill: true,
               borderWidth: 2,
               lineTension: 0,
               spanGaps: true,
               borderColor: '#efefef',
               pointRadius: 3,
               pointHoverRadius: 7,
               pointColor: '#efefef',
               pointBackgroundColor: '#efefef',
               data: [
                  @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                     {{ $ta->jml_siswa_baru }},
                  @endforeach
               ]
            }]
         }

         var jmlSiswaBaruGraphChartInititalOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
               display: false
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: false,
                     color: '#efefef',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Jumlah Siswa'
                  },
                  ticks: {
                     stepSize: 20,
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: true,
                     color: '#efefef',
                     drawBorder: false
                  }
               }]
            }
         }

         // This will get the first returned node in the jQuery collection.
         // eslint-disable-next-line no-unused-vars
         var jmlSiswaBaruGraphChartInitital = new Chart(
            jmlSiswaBaruGraphChartInititalCanvas, { // lgtm[js/unused-local-variable]
               type: 'line',
               data: jmlSiswaBaruGraphChartInititalData,
               options: jmlSiswaBaruGraphChartInititalOptions
            })

         //-------------
         //- JUMLAH SISWA KELUAR LINE CHART -
         //-------------
         var jmlSiswaKeluarGraphChartInititalCanvas = $('#jml-siswa-keluar-line-chart-initial').get(0).getContext('2d')

         var jmlSiswaKeluarGraphChartInititalData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
               label: 'Jumlah Siswa Keluar',
               fill: true,
               borderWidth: 2,
               lineTension: 0,
               spanGaps: true,
               borderColor: '#efefef',
               pointRadius: 3,
               pointHoverRadius: 7,
               pointColor: '#efefef',
               pointBackgroundColor: '#efefef',
               data: [
                  @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                     {{ $ta->jml_siswa_keluar }},
                  @endforeach
               ]
            }]
         }

         var jmlSiswaKeluarGraphChartInititalOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
               display: false
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: false,
                     color: '#efefef',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Jumlah Siswa'
                  },
                  ticks: {
                     stepSize: 2,
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: true,
                     color: '#efefef',
                     drawBorder: false
                  }
               }]
            }
         }

         // This will get the first returned node in the jQuery collection.
         // eslint-disable-next-line no-unused-vars
         var jmlSiswaKeluarGraphChartInitital = new Chart(
            jmlSiswaKeluarGraphChartInititalCanvas, { // lgtm[js/unused-local-variable]
               type: 'line',
               data: jmlSiswaKeluarGraphChartInititalData,
               options: jmlSiswaKeluarGraphChartInititalOptions
            })

         //-------------
         //- JUMLAH PRESTASI LINE CHART -
         //-------------
         var jmlPrestasiGraphChartInititalCanvas = $('#jml-prestasi-line-chart-initial').get(0).getContext('2d')

         var jmlPrestasiGraphChartInititalData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
               label: 'Jumlah Prestasi',
               fill: true,
               borderWidth: 2,
               lineTension: 0,
               spanGaps: true,
               borderColor: '#FFFFFF',
               pointRadius: 3,
               pointHoverRadius: 7,
               pointColor: '#FFFFFF',
               pointBackgroundColor: '#FFFFFF',
               data: [
                  @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                     {{ $ta->jml_prestasi }},
                  @endforeach
               ]
            }]
         }

         var jmlPrestasiGraphChartInititalOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
               display: false
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#FFFFFF',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#FFFFFF'
                  },
                  gridLines: {
                     display: false,
                     color: '#FFFFFF',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#FFFFFF',
                     labelString: 'Jumlah Prestasi'
                  },
                  ticks: {
                     stepSize: 5,
                     fontColor: '#FFFFFF'
                  },
                  gridLines: {
                     display: true,
                     color: '#FFFFFF',
                     drawBorder: false
                  }
               }]
            }
         }

         // This will get the first returned node in the jQuery collection.
         // eslint-disable-next-line no-unused-vars
         var jmlPrestasiGraphChartInitital = new Chart(
            jmlPrestasiGraphChartInititalCanvas, { // lgtm[js/unused-local-variable]
               type: 'line',
               data: jmlPrestasiGraphChartInititalData,
               options: jmlPrestasiGraphChartInititalOptions
            })

         //-------------
         //- JUMLAH PEGAWAI LINE CHART -
         //-------------
         var jmlPegawaiGraphChartInititalCanvas = $('#jml-pegawai-line-chart-initial').get(0).getContext('2d')

         var jmlPegawaiGraphChartInititalData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
               label: 'Jumlah Pegawai',
               fill: true,
               borderWidth: 2,
               lineTension: 0,
               spanGaps: true,
               borderColor: '#efefef',
               pointRadius: 3,
               pointHoverRadius: 7,
               pointColor: '#efefef',
               pointBackgroundColor: '#efefef',
               data: [
                  @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                     {{ $ta->jml_pegawai }},
                  @endforeach
               ]
            }]
         }

         var jmlPegawaiGraphChartInititalOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
               display: false
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: false,
                     color: '#efefef',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Jumlah Pegawai'
                  },
                  ticks: {
                     stepSize: 5,
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: true,
                     color: '#efefef',
                     drawBorder: false
                  }
               }]
            }
         }

         // This will get the first returned node in the jQuery collection.
         // eslint-disable-next-line no-unused-vars
         var jmlPegawaiGraphChartInitital = new Chart(
            jmlPegawaiGraphChartInititalCanvas, { // lgtm[js/unused-local-variable]
               type: 'line',
               data: jmlPegawaiGraphChartInititalData,
               options: jmlPegawaiGraphChartInititalOptions
            })

         //-------------
         //- JUMLAH SURAT BAR CHART -
         //-------------
         var jmlSuratBarChartCanvas = $('#jml-surat-barChart-initial').get(0).getContext('2d')
         var jmlSuratBarChartData = {
            labels: [
               @foreach ($tahun_ajaran->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran') as $ta)
                  "{{ $ta->tahun_ajaran }}",
               @endforeach
            ],
            datasets: [{
                  label: 'Surat Masuk',
                  backgroundColor: '#F1E0C5',
                  borderColor: '#F1E0C5',
                  pointRadius: false,
                  pointColor: '#3b8bba',
                  pointStrokeColor: '#F1E0C5',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: '#F1E0C5',
                  data: [
                     @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                        {{ $ta->jml_surat_masuk }},
                     @endforeach
                  ]
               },
               {
                  label: 'Surat Keluar',
                  backgroundColor: '#17BEBB',
                  borderColor: '#17BEBB',
                  pointRadius: false,
                  pointColor: '#17BEBB',
                  pointStrokeColor: '#17BEBB',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: '#17BEBB',
                  data: [
                     @foreach ($tahun_ajaran->sortBy('tahun_ajaran') as $ta)
                        {{ $ta->jml_surat_keluar }},
                     @endforeach
                  ]
               },
            ]
         }

         var jmlSuratBarChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            legend: {
               display: true,
               labels: {
                  fontColor: '#efefef'
               }
            },
            scales: {
               xAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Tahun Pelajaran'
                  },
                  ticks: {
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: false,
                     color: '#efefef',
                     drawBorder: false
                  }
               }],
               yAxes: [{
                  scaleLabel: {
                     display: true,
                     fontColor: '#efefef',
                     labelString: 'Jumlah Surat'
                  },
                  ticks: {
                     stepSize: 10,
                     fontColor: '#efefef'
                  },
                  gridLines: {
                     display: true,
                     color: '#efefef',
                     drawBorder: false
                  }
               }]
            }
         }

         new Chart(jmlSuratBarChartCanvas, {
            type: 'bar',
            data: jmlSuratBarChartData,
            options: jmlSuratBarChartOptions
         })
      }
   </script>
@endsection
