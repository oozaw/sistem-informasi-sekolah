@if (session()->has('success'))
   <div class="successAlert" hidden>{{ session('success') }}</div>
@endif
@if (session()->has('fail'))
   <div class="failAlert" hidden>{{ session('fail') }}</div>
@endif
