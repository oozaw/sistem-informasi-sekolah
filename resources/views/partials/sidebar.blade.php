<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="" class="brand-link">
      <img src="/img/smanel-logo.png" alt="SMANEL Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
      <span class="brand-text font-weight-light ml-2">SIM - SMANEL</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-1 pb-1 mb-3 d-flex">
         @if ($user->pegawai && $user->pegawai->foto_profil)
            <div class="image pl-1">
               <img src="/storage/{{ $user->pegawai->foto_profil }}" class="img-circle elevation-2 mt-2"
                  alt="User Image" style="width: 32px; height: 32px; object-fit: cover; object-position: center">
            </div>
         @else
            <div class="img-circle bg-secondary elevation-2"
               style="width: 2rem; height: 2rem; margin-top: 9px; margin-left: 3px">
               <i class="fas fa-user-circle fa-2x" style="margin-top: 1px"></i>
            </div>
         @endif
         <div class="info pl-2">
            <a href="/profile"
               class="d-block text-sm">{{ $user->role == 1 ? 'Administrator' : $user->pegawai->nama }}</a>
            <span class="d-block text-white-50" style="font-size: smaller">
               @if ($user->role == 1)
                  {{ 'Admin' }}
               @elseif ($user->role == 2)
                  {{ 'Guru' }}
               @elseif ($user->role == 4)
                  {{ 'Kepala Sekolah' }}
               @else
                  {{ 'Tata Usaha' }}
               @endif
            </span>
         </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
         <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
               <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
               </button>
            </div>
         </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
            <li class="nav-item">
               <a href="/dashboard" class="nav-link {{ $part == 'dashboard' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-home"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            <li
               class="nav-item {{ $part == 'pengguna' || $part == 'kepsek' || $part == 'tahun-ajaran' ? 'menu-open' : '' }}">
               <a href="#"
                  class="nav-link {{ $part == 'pengguna' || $part == 'kepsek' || $part == 'tahun-ajaran' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tools"></i>
                  <p>
                     Administrator
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="/tahun-ajaran/{{ App\Models\TahunAjaran::where('status', '1')->first()->id }}"
                        class="nav-link {{ $part == 'tahun-ajaran' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cabinet-filing"></i>
                        <p>Tahun Pelajaran</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/pengguna" class="nav-link {{ $part == 'pengguna' ? 'active' : '' }}">
                        <i class="nav-icon fad fa-users"></i>
                        <p>Data Pengguna</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/kepala-sekolah" class="nav-link {{ $part == 'kepsek' ? 'active' : '' }}">
                        <i class="fas fa-user-crown nav-icon"></i>
                        <p>Data Kepala Sekolah</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item {{ $part == 'kelas' || $part == 'siswa' || $part == 'prestasi' ? 'menu-open' : '' }}">
               <a href="#"
                  class="nav-link {{ $part == 'kelas' || $part == 'siswa' || $part == 'prestasi' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-graduation-cap"></i>
                  <p>
                     Akademik
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="/kelas" class="nav-link {{ $part == 'kelas' ? 'active' : '' }}">
                        <i class="fas fa-chalkboard nav-icon"></i>
                        <p>Data Kelas</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/siswa" class="nav-link {{ $part == 'siswa' ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Data Siswa</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/prestasi" class="nav-link {{ $part == 'prestasi' ? 'active' : '' }}">
                        <i class="fas fa-medal nav-icon"></i>
                        <p>Data Prestasi</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li
               class="nav-item {{ $part == 'guru' || $part == 'tu' || $part == 'lainnya' || $part == 'kepegawaian' || $part == 'pegawai' ? 'menu-open' : '' }}">
               <a href="#"
                  class="nav-link {{ $part == 'guru' || $part == 'tu' || $part == 'lainnya' || $part == 'kepegawaian' || $part == 'pegawai' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     Kepegawaian
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="/pekerja" class="nav-link {{ $part == 'pegawai' ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Data Seluruh Pegawai</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/guru"
                        class="nav-link {{ $part == 'guru' ? 'active' : '' }} @if (isset($pekerja)) {{ $pekerja->jabatan == 'Guru' ? 'active' : '' }} @endif">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Data Guru</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/tata-usaha"
                        class="nav-link {{ $part == 'tu' ? 'active' : '' }} @if (isset($pekerja)) {{ $pekerja->jabatan == 'Staf Tata Usaha' ? 'active' : '' }} @endif">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>Data Staf Tata Usaha</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/staf-lain"
                        class="nav-link {{ $part == 'lainnya' ? 'active' : '' }} @if (isset($pekerja)) {{ $pekerja->jabatan == 'Staf Lainnya' ? 'active' : '' }} @endif">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Data Pegawai Lain</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li
               class="nav-item {{ $part == 'surat-masuk' || $part == 'surat-keluar' || $part == 'keuangan' || $part == 'komite' || $part == 'bos' ? 'menu-open' : '' }}">
               <a href="#"
                  class="nav-link {{ $part == 'surat-masuk' || $part == 'surat-keluar' || $part == 'keuangan' || $part == 'komite' || $part == 'bos' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-paste"></i>
                  <p>
                     Tata Usaha
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="/surat-masuk" class="nav-link {{ $part == 'surat-masuk' ? 'active' : '' }}">
                        <i class="fas fa-inbox-in nav-icon"></i>
                        <p>Surat Masuk</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/surat-keluar" class="nav-link {{ $part == 'surat-keluar' ? 'active' : '' }}">
                        <i class="fas fa-inbox-out nav-icon"></i>
                        <p>Surat Keluar</p>
                     </a>
                  </li>
                  <li class="nav-item {{ $part == 'komite' || $part == 'bos' ? 'menu-open' : '' }}">
                     <a href="/komite" class="nav-link {{ $part == 'komite' ? 'active' : '' }}">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>Komite</p>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
