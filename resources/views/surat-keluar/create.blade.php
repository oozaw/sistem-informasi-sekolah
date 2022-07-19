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
                  <h1>Buat Surat Baru</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Tata Usaha</li>
                     <li class="breadcrumb-item">Surat Keluar</li>
                     <li class="breadcrumb-item active">Buat Surat Baru</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="card card-success">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <h4 class="m-0">Data Surat Baru</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/surat-keluar-generate" id="main_form" target="_blank"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="individu_tujuan">Individu Tujuan</label>
                                    <input type="text"
                                       class="form-control @error('individu_tujuan') is-invalid @enderror"
                                       id="individu_tujuan" name="individu_tujuan"
                                       placeholder="Masukkan individu tujuan surat" value="{{ old('individu_tujuan') }}"
                                       autofocus>
                                    <span><small class="text-danger error-text individu_tujuan_error ml-1"
                                          hidden></small></span>
                                    @error('individu_tujuan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tujuan">Instansi/Organisasi Tujuan</label>
                                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                       id="tujuan" name="tujuan" placeholder="Masukkan tujuan surat"
                                       value="{{ old('tujuan') }}">
                                    <span><small class="text-danger error-text tujuan_error ml-1" hidden></small></span>
                                    @error('tujuan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="lampiran">Lampiran</label>
                                    <input type="text" class="form-control @error('lampiran') is-invalid @enderror"
                                       id="lampiran" name="lampiran" placeholder="Masukkan lampiran surat"
                                       value="{{ old('lampiran') }}">
                                    <span><small class="text-danger error-text lampiran_error ml-1" hidden></small></span>
                                    @error('lampiran')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control @error('perihal') is-invalid @enderror"
                                       id="perihal" name="perihal" placeholder="Masukkan perihal"
                                       value="{{ old('perihal') }}">
                                    <span><small class="text-danger error-text perihal_error ml-1" hidden></small></span>
                                    @error('perihal')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="no_surat">No Surat</label>
                              <div class="form-row mb-0">
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                       name="nomor" id="nomor" placeholder="Nomor" value="{{ old('nomor') }}">
                                    <span><small class="text-danger error-text nomor_error ml-1" hidden></small></span>
                                    @error('nomor')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('kode_tujuan') is-invalid @enderror"
                                       name="kode_tujuan" id="kode_tujuan" placeholder="Kode Tujuan"
                                       value="{{ old('kode_tujuan') }}">
                                    <span><small class="text-danger error-text kode_tujuan_error ml-1"
                                          hidden></small></span>
                                    @error('kode_tujuan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('instansi_asal') is-invalid @enderror"
                                       name="instansi_asal" id="instansi_asal" value="SMAN.5.Mrg" readonly>
                                    <span><small class="text-danger error-text instansi_asal_error ml-1"
                                          hidden></small></span>
                                    @error('instansi_asal')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>/</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <select class="form-control @error('bulan') is-invalid @enderror" name="bulan"
                                       id="bulan">
                                       @if (old('bulan') == 'I')
                                          <option value="I" selected>Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'II')
                                          <option value="I">Januari</option>
                                          <option value="II" selected>Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'III')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III" selected>Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'IV')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV" selected>April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'V')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V" selected>Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'VI')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI" selected>Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'VII')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII" selected>Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'VIII')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII" selected>Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'IX')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX" selected>September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'X')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X" selected>Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'XI')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI" selected>November</option>
                                          <option value="XII">Desember</option>
                                       @elseif (old('bulan') == 'XII')
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII" selected>Desember</option>
                                       @else
                                          <option value="" selected disabled hidden>-- Pilih bulan --
                                          </option>
                                          <option value="I">Januari</option>
                                          <option value="II">Februari</option>
                                          <option value="III">Maret</option>
                                          <option value="IV">April</option>
                                          <option value="V">Mei</option>
                                          <option value="VI">Juni</option>
                                          <option value="VII">Juli</option>
                                          <option value="VIII">Agustus</option>
                                          <option value="IX">September</option>
                                          <option value="X">Oktober</option>
                                          <option value="XI">November</option>
                                          <option value="XII">Desember</option>
                                       @endif
                                    </select>
                                    <span><small class="text-danger error-text bulan_error ml-1" hidden></small></span>
                                    @error('bulan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="form-group mb-0">
                                    <h5 class="mx-1 pt-1 mb-0 text-secondary"><strong>-</strong></h5>
                                 </div>
                                 <div class="form-group col-md-2 mb-0">
                                    <input type="text" class="form-control @error('tahun') is-invalid @enderror"
                                       name="tahun" id="tahun" placeholder="Tahun" value="{{ old('tahun') }}">
                                    <span><small class="text-danger error-text tahun_error ml-1" hidden></small></span>
                                    @error('tahun')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="tgl_keluar">Tanggal Keluar</label>
                                    <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror"
                                       id="tgl_keluar" name="tgl_keluar" placeholder="Masukkan tanggal keluar"
                                       value="{{ old('tgl_keluar') }}">
                                    <span><small class="text-danger error-text tgl_keluar_error ml-1"
                                          hidden></small></span>
                                    @error('tgl_keluar')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                       id="keterangan" name="keterangan" placeholder="Masukkan keterangan"
                                       value="{{ old('keterangan') }}">
                                    <span><small class="text-danger error-text keterangan_error ml-1"
                                          hidden></small></span>
                                    @error('keterangan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="isi_surat">Isi Surat</label>
                              <textarea name="isi_surat" id="isi_surat" class="form-control @error('isi_surat') is-invalid @enderror">{!! old('isi_surat') !!}</textarea>
                              <span><small class="text-danger error-text isi_surat_error ml-1" hidden></small></span>
                              @error('isi_surat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <a href="{{ URL::previous() }}" class="btn btn-secondary">Batal</a>
                           <a href="/surat-keluar-generate" class="btn bg-gradient-purple"
                              id="preview_submit">Pratinjau</a>
                           <button class="btn btn-success" type="submit" id="print_button" hidden>Simpan dan
                              Unduh</button>
                        </div>
                     </form>
                     <hr class="mt-0" id="pembatas_preview" hidden>
                     <div id="preview" class="card mx-auto mb-3"
                        style="width: 210mm; height: 297mm; line-height: 1.2rem" hidden>
                     </div>
                  </div>
                  <!-- /.card -->
               </div>
               <!-- /.col -->
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
   <script src="/jquery/jquery-3.6.0.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- bs-custom-file-input -->
   <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   {{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}
   <script src="/ckeditor/build/ckeditor.js"></script>
   <script>
      $(document).ready(function() {
         $('#preview_submit').on('click', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('surat-keluar-preview') }}",
               method: "post",
               data: {
                  individu_tujuan: $("#individu_tujuan").val(),
                  tujuan: $("#tujuan").val(),
                  lampiran: $("#lampiran").val(),
                  perihal: $("#perihal").val(),
                  nomor: $("#nomor").val(),
                  kode_tujuan: $("#kode_tujuan").val(),
                  instansi_asal: $("#instansi_asal").val(),
                  bulan: $("#bulan").val(),
                  tahun: $("#tahun").val(),
                  tgl_keluar: $("#tgl_keluar").val(),
                  keterangan: $("#keterangan").val(),
                  isi_surat: isiSuratEditor.getData()
               },
               beforeSend: function() {
                  $("#preview").text('');
                  $(document).find('small.error-text').text('');
                  $("input.form-control").removeClass("is-invalid");
                  $("select.form-control").removeClass("is-invalid");
               },
               success: function(result) {
                  if (result.status == 0) {
                     $.each(result.error, function(prefix, val) {
                        $("input#" + prefix).addClass("is-invalid");
                        $("select#" + prefix).addClass("is-invalid");
                        $("small." + prefix + "_error").text(val[0]).prop("hidden", false);
                     });
                  } else {
                     $("#preview").append(result);
                     $("#preview").prop('hidden', false);
                     $("#pembatas_preview").prop('hidden', false);
                     $("#print_button").prop('hidden', false);
                  }
               }
            });
         });

      });

      $(function() {
         bsCustomFileInput.init();
      });

      let isiSuratEditor;
      ClassicEditor
         .create(document.querySelector('#isi_surat'))
         .then(newEditor => {
            isiSuratEditor = newEditor;
         })
         .catch(error => {
            console.error(error);
         });
   </script>
@endsection
