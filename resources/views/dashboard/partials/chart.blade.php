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
         <canvas class="chart chartjs-render-monitor" id="jml-siswa-line-chart"
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
         <canvas class="chart chartjs-render-monitor" id="jml-siswa-baru-line-chart"
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
         <canvas class="chart chartjs-render-monitor" id="jml-siswa-keluar-line-chart"
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
         <canvas class="chart chartjs-render-monitor" id="jml-prestasi-line-chart"
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
         <canvas class="chart chartjs-render-monitor" id="jml-pegawai-line-chart"
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
            <canvas class="chartjs-render-monitor" id="jml-surat-barChart"
               style="min-height: 250px; height: 257px; max-height: 257px; max-width: 100%; display: block; width: 410px;"
               width="820" height="500"></canvas>
         </div>
      </div>
   </div>
</div>


<script>
   $(function() {
      //-------------
      //- JUMLAH SISWA LINE CHART -
      //-------------
      var jmlSiswaGraphChartCanvas = $('#jml-siswa-line-chart').get(0).getContext('2d')

      var jmlSiswaGraphChartData = {
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

      var jmlSiswaGraphChartOptions = {
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
      var jmlSiswaGraphChart = new Chart(jmlSiswaGraphChartCanvas, { // lgtm[js/unused-local-variable]
         type: 'line',
         data: jmlSiswaGraphChartData,
         options: jmlSiswaGraphChartOptions
      })

      //-------------
      //- JUMLAH SISWA BARU LINE CHART -
      //-------------
      var jmlSiswaBaruGraphChartCanvas = $('#jml-siswa-baru-line-chart').get(0).getContext('2d')

      var jmlSiswaBaruGraphChartData = {
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

      var jmlSiswaBaruGraphChartOptions = {
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
      var jmlSiswaBaruGraphChart = new Chart(jmlSiswaBaruGraphChartCanvas, { // lgtm[js/unused-local-variable]
         type: 'line',
         data: jmlSiswaBaruGraphChartData,
         options: jmlSiswaBaruGraphChartOptions
      })

      //-------------
      //- JUMLAH SISWA KELUAR LINE CHART -
      //-------------
      var jmlSiswaKeluarGraphChartCanvas = $('#jml-siswa-keluar-line-chart').get(0).getContext('2d')

      var jmlSiswaKeluarGraphChartData = {
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

      var jmlSiswaKeluarGraphChartOptions = {
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
      var jmlSiswaKeluarGraphChart = new Chart(jmlSiswaKeluarGraphChartCanvas, { // lgtm[js/unused-local-variable]
         type: 'line',
         data: jmlSiswaKeluarGraphChartData,
         options: jmlSiswaKeluarGraphChartOptions
      })

      //-------------
      //- JUMLAH PRESTASI LINE CHART -
      //-------------
      var jmlPrestasiGraphChartCanvas = $('#jml-prestasi-line-chart').get(0).getContext('2d')

      var jmlPrestasiGraphChartData = {
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

      var jmlPrestasiGraphChartOptions = {
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
      var jmlPrestasiGraphChart = new Chart(jmlPrestasiGraphChartCanvas, { // lgtm[js/unused-local-variable]
         type: 'line',
         data: jmlPrestasiGraphChartData,
         options: jmlPrestasiGraphChartOptions
      })

      //-------------
      //- JUMLAH PEGAWAI LINE CHART -
      //-------------
      var jmlPegawaiGraphChartCanvas = $('#jml-pegawai-line-chart').get(0).getContext('2d')

      var jmlPegawaiGraphChartData = {
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

      var jmlPegawaiGraphChartOptions = {
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
      var jmlPegawaiGraphChart = new Chart(jmlPegawaiGraphChartCanvas, { // lgtm[js/unused-local-variable]
         type: 'line',
         data: jmlPegawaiGraphChartData,
         options: jmlPegawaiGraphChartOptions
      })

      //-------------
      //- JUMLAH SURAT BAR CHART -
      //-------------
      var jmlSuratBarChartCanvas = $('#jml-surat-barChart').get(0).getContext('2d')
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
   })
</script>
