<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span
               class="badge badge-warning navbar-badge">{{ $piagamKosong->count() != 0 ? $piagamKosong->count() : '' }}</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifikasi</span>
            <div class="dropdown-divider"></div>
            @if ($piagamKosong->count() != 0)
               <a href="/prestasi" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i> {{ $piagamKosong->count() }} piagam prestasi belum diunggah
                  {{-- <span class="float-right text-muted text-sm">3 mins</span> --}}
               </a>
            @endif
         </div>
      </li>
      <li class="nav-item">
         <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn bg-transparent nav-link">
               <span>Keluar <i class="ml-1 fas fa-sign-out"></i></span>
            </button>
         </form>
      </li>
   </ul>
</nav>
