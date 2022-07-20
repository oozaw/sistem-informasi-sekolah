<option selected disabled hidden value="">-- Pilih pegawai --</option>
@foreach ($pegawai as $p)
   @if (old('pegawai_id') == $p->id)
      <option value="{{ $p->id }}" selected>{{ $p->nama }}</option>
   @else
      <option value="{{ $p->id }}">{{ $p->nama }}</option>
   @endif
@endforeach
