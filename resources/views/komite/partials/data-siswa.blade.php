@foreach ($siswa as $s)
   @if (old('siswa_id') == $s->id)
      <option value="{{ $s->id }}" selected>{{ $s->nama }}</option>
   @else
      <option value="{{ $s->id }}">{{ $s->nama }}</option>
   @endif
@endforeach
