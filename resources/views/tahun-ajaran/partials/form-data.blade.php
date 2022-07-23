<div class="row">
   <div class="col-sm-6">
      <div class="form-group">
         <label for="jml_siswa">Jumlah Keseluruhan Siswa</label>
         <input type="text" class="form-control @error('jml_siswa') is-invalid @enderror" id="jml_siswa" name="jml_siswa"
            placeholder="Masukkan jumlah keseluruhan siswa" value="{{ old('jml_siswa') }}">
         @error('jml_siswa')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="form-group">
         <label for="jml_siswa_baru">Jumlah Siswa Baru</label>
         <input type="text" class="form-control @error('jml_siswa_baru') is-invalid @enderror" id="jml_siswa_baru"
            name="jml_siswa_baru" placeholder="Masukkan jumlah siswa baru" value="{{ old('jml_siswa_baru') }}">
         @error('jml_siswa_baru')
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
         <label for="jml_siswa_lulus">Jumlah Siswa Lulus</label>
         <input type="text" class="form-control @error('jml_siswa_lulus') is-invalid @enderror" id="jml_siswa_lulus"
            name="jml_siswa_lulus" placeholder="Masukkan jumlah siswa lulus" value="{{ old('jml_siswa_lulus') }}">
         @error('jml_siswa_lulus')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="form-group">
         <label for="jml_siswa_keluar">Jumlah Siswa Keluar/Pindah</label>
         <input type="text" class="form-control @error('jml_siswa_keluar') is-invalid @enderror"
            id="jml_siswa_keluar" name="jml_siswa_keluar" placeholder="Masukkan jumlah siswa keluar/pindah"
            value="{{ old('jml_siswa_keluar') }}">
         @error('jml_siswa_keluar')
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
         <label for="jml_prestasi">Jumlah Prestasi</label>
         <input type="text" class="form-control @error('jml_prestasi') is-invalid @enderror" id="jml_prestasi"
            name="jml_prestasi" placeholder="Masukkan jumlah prestasi" value="{{ old('jml_prestasi') }}">
         @error('jml_prestasi')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="form-group">
         <label for="jml_pegawai">Jumlah Pegawai</label>
         <input type="text" class="form-control @error('jml_pegawai') is-invalid @enderror" id="jml_pegawai"
            name="jml_pegawai" placeholder="Masukkan jumlah pegawai" value="{{ old('jml_pegawai') }}">
         @error('jml_pegawai')
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
         <label for="jml_surat_masuk">Jumlah Surat Masuk</label>
         <input type="text" class="form-control @error('jml_surat_masuk') is-invalid @enderror" id="jml_surat_masuk"
            name="jml_surat_masuk" placeholder="Masukkan jumlah surat masuk" value="{{ old('jml_surat_masuk') }}">
         @error('jml_surat_masuk')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="form-group">
         <label for="jml_surat_keluar">Jumlah Surat Keluar</label>
         <input type="text" class="form-control @error('jml_surat_keluar') is-invalid @enderror"
            id="jml_surat_keluar" name="jml_surat_keluar" placeholder="Masukkan jumlah surat keluar"
            value="{{ old('jml_surat_keluar') }}">
         @error('jml_surat_keluar')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
         @enderror
      </div>
   </div>
</div>
