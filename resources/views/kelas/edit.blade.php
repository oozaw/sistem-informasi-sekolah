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
                     <li class="breadcrumb-item">Data Kelas</li>
                     <li class="breadcrumb-item active">Edit Data Kelas</li>
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
                           <h4 class="m-0">Data Kelas {{ $kelas->nama }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <form method="POST" action="/kelas/{{ $kelas->id }}">
                        @method('put')
                        @csrf
                        <div class="card-body pb-0">
                           <div class="form-group">
                              <label for="tingkatan">Tingkatan</label>
                              <select class="form-control @error('tingkatan') is-invalid @enderror" name="tingkatan">
                                 <option selected disabled hidden value="">-- Pilih tingkatan --</option>
                                 @if (old('tingkatan', $kelas->tingkatan) == 10)
                                    <option value="10" selected>10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                 @elseif (old('tingkatan', $kelas->tingkatan) == 11)
                                    <option value="10">10</option>
                                    <option value="11" selected>11</option>
                                    <option value="12">12</option>
                                 @elseif (old('tingkatan', $kelas->tingkatan) == 12)
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12" selected>12</option>
                                 @else
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                 @endif
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                 name="nama" placeholder="Masukkan nama kelas" value="{{ old('nama', $kelas->nama) }}"
                                 autofocus>
                              @error('nama')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Wali Kelas</label>
                              <select class="form-control @error('wali_kelas_id') is-invalid @enderror"
                                 name="wali_kelas_id">
                                 <option selected disabled hidden value="">-- Pilih wali kelas --</option>
                                 @foreach ($wali_kelas as $wk)
                                    @if (old('wali_kelas_id', $kelas->wali_kelas_id) == $wk->id)
                                       <option value="{{ $wk->id }}" selected>{{ $wk->nama }}</option>
                                    @else
                                       <option value="{{ $wk->id }}">{{ $wk->nama }}</option>
                                    @endif
                                 @endforeach
                              </select>
                              @error('wali_kelas_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                           <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                           <a href="{{ URL::previous() }}" class="btn btn-secondary">Batal</a>
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
   </script>
@endsection
