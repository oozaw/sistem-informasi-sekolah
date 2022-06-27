<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title }}</title>

   {{-- Icon --}}
   <link rel="icon" type="image/gif/png" href="/img/smanel-logo.png">
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   {{-- <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css"> --}}
   <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">
   <!-- Ionicons -->
   <link rel="stylesheet" href="/adminlte/plugins/ionicons/css/ionicons.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   @yield('head')

</head>

<body class="hold-transition sidebar-mini">
   <!-- Site wrapper -->
   <div class="wrapper">

      <!-- Navbar -->
      @include('partials.navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      @yield('container')
      <!-- /.content-wrapper -->

      <!-- Footer -->
      <footer class="main-footer">
         {{-- <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.1.0
         </div>
         <strong>Copyright &copy; 2022 <a href="https://github.com/oozaw">Wahyu Purnomo Ady</a>.</strong> All rights
         reserved. --}}
      </footer>
      <!-- /.footer -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   @yield('script')

</body>

</html>
