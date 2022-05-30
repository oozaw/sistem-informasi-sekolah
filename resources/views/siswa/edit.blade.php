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
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item">Data Siswa</li>
                     <li class="breadcrumb-item active">Edit Data Siswa</li>
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
                  <div class="card card-primary">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           <h4 class="m-0">Data {{ $siswa->nama }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/siswa/{{ $siswa->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                 name="nama" placeholder="Masukkan nama siswa" value="{{ old('nama', $siswa->nama) }}"
                                 autofocus>
                              @error('nama')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="nis">NIS</label>
                              <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                 name="nis" placeholder="Masukkan nis siswa" value="{{ old('nis', $siswa->nis) }}">
                              @error('nis')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="nisn">NISN</label>
                              <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                 name="nisn" placeholder="Masukkan nisn siswa" value="{{ old('nisn', $siswa->nisn) }}">
                              @error('nisn')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                 <option selected disabled hidden value="">-- Pilih jenis kelamin --</option>
                                 @if (old('gender', $siswa->gender) == 'Laki-laki')
                                    <option value="Laki-laki" selected>Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                 @elseif (old('gender', $siswa->gender) == 'Perempuan')
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan" selected>Perempuan</option>
                                 @else
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                 @endif
                              </select>
                              @error('gender')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="no_telp">Nomor Telepon</label>
                              <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                 name="no_telp" placeholder="Masukkan nomor telepon siswa"
                                 value="{{ old('no_telp', $siswa->no_telp) }}">
                              @error('no_telp')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                 <option selected disabled hidden value="">-- Pilih kelas --</option>
                                 @foreach ($kelas as $k)
                                    @if (old('kelas_id', $siswa->kelas->id) == $k->id)
                                       <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
                                    @else
                                       <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endif
                                 @endforeach
                              </select>
                              @error('kelas_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group" id="prestasi_form">
                              @foreach ($prestasiSiswa as $ps)
                                 <label for="prestasi{{ $loop->iteration }}"
                                    class="{{ $loop->iteration != 1 ? 'mt-3' : '' }}">Prestasi
                                    {{ $loop->iteration }}</label><select class="form-control"
                                    name="prestasi{{ $loop->iteration }}" id="prestasi{{ $loop->iteration }}"
                                    required>
                                    <option value="kosong">-- Tidak ada --</option>
                                    @foreach ($prestasi as $p)
                                       @if ($p->id == $ps->prestasi_id)
                                          <option value="{{ $p->id }}" selected>{{ $p->capaian }}
                                             {{ $p->nama }}
                                             {{ $p->tahun }}</option>
                                       @else
                                          <option value="{{ $p->id }}">{{ $p->capaian }}
                                             {{ $p->nama }}
                                             {{ $p->tahun }}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              @endforeach
                           </div>
                           <div class="form-group row mt-4 mb-3">
                              <label for="option_prestasi" class="col-form-label pr-0 mx-2 mr-3">Tambah Prestasi?</label>
                              <div class="col-2 pl-0 mr-3">
                                 <select class="form-control" name="option_prestasi" id="option_prestasi"
                                    onchange="cekPrestasi()" required>
                                    <option value="no" selected>Tidak</option>
                                    <option value="yes">Ya</option>
                                 </select>
                              </div>
                              <label id="label_jumlah_prestasi" for="jumlah_prestasi" class="col-form-label pr-0 mx-2 mr-3"
                                 hidden>Jumlah</label>
                              <div id="jumlah_prestasi_area" class="col-2 pl-0 mr-3"></div>
                           </div>
                           <div class="form-group" id="tambah_prestasi_form"></div>
                           <div class="form-group">
                              <label for="tempat_tinggal">Tempat Tinggal</label>
                              <input type="text" class="form-control @error('tempat_tinggal') is-invalid @enderror"
                                 id="tempat_tinggal" name="tempat_tinggal" placeholder="Masukkan tempat tinggal siswa"
                                 value="{{ old('tempat_tinggal', $siswa->tempat_tinggal) }}">
                              @error('tempat_tinggal')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <label for="foto_profil">Foto Profil</label>
                           <div class="custom-file mb-2">
                              <input type="file" class="custom-file-input @error('foto_profil') is-invalid @enderror"
                                 id="foto_profil" name="foto_profil">
                              <label class="custom-file-label" for="foto_profil" data-browse="Pilih file">Unggah foto
                                 profil</label>
                              @error('foto_profil')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                           <a href="/siswa" class="btn btn-secondary">Batal</a>
                        </div>
                     </form>
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
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- bs-custom-file-input -->
   <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(function() {
         bsCustomFileInput.init();
      });

      function cekPrestasi() {
         let optionTambah = document.querySelector("#option_prestasi").value;
         let area = document.querySelector("#jumlah_prestasi_area");
         let label = document.querySelector("#label_jumlah_prestasi");
         let prestasiForm = document.querySelector("#tambah_prestasi_form");
         let jumlahPrestasi = {{ $jumlahPrestasi }};

         if (optionTambah == "yes") {
            label.removeAttribute("hidden");
            area.innerHTML =
               '<input type="number" class="form-control" id="jumlah_prestasi" name="jumlah_prestasi"placeholder="Jumlah prestasi" value="1" min="1" oninput="cekjumlahTambahPrestasi()">';
            prestasiForm.innerHTML =
               '<label for="prestasi' + (jumlahPrestasi + 1) +
               '">Prestasi ' + (jumlahPrestasi + 1) +
               '</label><select class="form-control" name="prestasi' + (jumlahPrestasi + 1) + '" id="prestasi' + (
                  jumlahPrestasi + 1) +
               '" required><option value="" selected disabled hidden>-- Pilih prestasi --</option>' +
               @foreach ($prestasi as $p)
                  '<option value="{{ $p->id }}">{{ $p->capaian }} {{ $p->nama }} {{ $p->tahun }}</option>' +
               @endforeach
            '</select>';
         } else {
            label.setAttribute("hidden", true);
            area.innerHTML = "";
            prestasiForm.innerHTML = "";
         }
      }

      function cekjumlahTambahPrestasi() {
         let jumlahPrestasi = {{ $jumlahPrestasi }};
         let jumlahTambahPrestasi = document.querySelector("#jumlah_prestasi").value;
         let prestasiForm = document.querySelector("#tambah_prestasi_form");
         let form = '';
         let kelas = '';

         for (index = 1; index <= jumlahTambahPrestasi; index++) {
            if (index != 1) {
               kelas = "class=mt-3";
            }

            form = form +
               '<label for="prestasi' + (jumlahPrestasi + index) + '"' + kelas +
               '>Prestasi ' + (jumlahPrestasi + index) +
               '</label><select class="form-control" name="prestasi' + (jumlahPrestasi + index) +
               '" id="prestasi' + (jumlahPrestasi + index) +
               '" required><option value="" selected disabled hidden>-- Pilih prestasi --</option>' +
               @foreach ($prestasi as $p)
                  '<option value="{{ $p->id }}">{{ $p->capaian }} {{ $p->nama }} {{ $p->tahun }}</option>' +
               @endforeach
            '</select>';
         }

         prestasiForm.innerHTML = form;
      }
   </script>
@endsection
