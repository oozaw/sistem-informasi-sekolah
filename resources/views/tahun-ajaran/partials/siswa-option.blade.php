@for ($i = 1; $i <= $jml_siswa; $i++)
   <div class="form-group row mb-3 ml-2">
      <label for="siswa_{{ $i }}" class="col-form-label ml-2 mr-4">Siswa {{ $i }}</label>
      <div class="col-3 pl-0 mr-3 ml-1">
         <select class="form-control" name="siswa_{{ $i }}" id="siswa_{{ $i }}" required>
            <option value="" disabled hidden selected>-- Pilih siswa --</option>
            @foreach ($siswa as $s)
               <option value="{{ $s->id }}">{{ $s->nama }}</option>
            @endforeach
         </select>
      </div>
      <div class="col-1">
         <label class="col-form-label text-danger">Tinggal</label>
      </div>
      <label for="kelas_tinggal_{{ $i }}" class="col-form-label mr-3 ml-0">di Kelas</label>
      <div class="col-2">
         <select class="form-control" name="kelas_tinggal_{{ $i }}" id="kelas_tinggal_{{ $i }}"
            required>
            <option value="" disabled hidden selected>-- Pilih kelas --</option>
            @foreach ($kelas as $k)
               <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
         </select>
      </div>
   </div>
@endfor
