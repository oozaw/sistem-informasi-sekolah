<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="" class="brand-link">
      <img src="/img/smanel-logo.png" alt="SMANEL Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
      <span class="brand-text font-weight-light ml-2">SMA N 5 Merangin</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="/img/profil-me.png" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block">Wahyu Purnomo Ady</a>
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
               <a href="/" class="nav-link {{ $part == 'dashboard' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-home"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            <li class="nav-item {{ $part == 'kelas' || $part == 'siswa' ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ $part == 'kelas' || $part == 'siswa' ? 'active' : '' }}">
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
               </ul>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     Kepegawaian
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Data Guru</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>Data Staf Tata Usaha</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Data Tenaga Kerja Lain</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item">
               <a href="/" class="nav-link">
                  <i class="nav-icon fas fa-paste"></i>
                  <p>
                     Tata Usaha
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="" class="nav-link">
                        <i class="fas fa-inbox-in nav-icon"></i>
                        <p>Surat Masuk</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="" class="nav-link">
                        <i class="fas fa-inbox-out nav-icon"></i>
                        <p>Surat Keluar</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="" class="nav-link">
                        <i class="fas fa-calculator nav-icon"></i>
                        <p>
                           Keuangan
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="" class="nav-link">
                              <i class="fas fa-money-check-alt nav-icon"></i>
                              <p>
                                 Komite
                              </p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="" class="nav-link">
                              <i class="fas fa-money-check nav-icon"></i>
                              <p>
                                 Uang Pangkal
                              </p>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
