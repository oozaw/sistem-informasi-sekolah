@extends('layouts.main')

@section('head')
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="d-inline-flex"></div>
               <div class="col-sm-6">
                  <h1>{{ $title }}</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Administrator</li>
                     <li class="breadcrumb-item">Data Pengguna</li>
                     <li class="breadcrumb-item active">Detail Pengguna</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-4">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">{{ $pengguna->username }}</h3>
                     </div>
                     <div class="widget-user-image">
                        @if ($profil && $profil->foto_profil)
                           <img class="img-circle elevation-2"
                              style="width: 90px; height: 90px; object-fit: cover; object-position: center"
                              src="/storage/{{ $profil->foto_profil }}" alt="Foto profil pekerja">
                        @else
                           <div class="img-circle bg-secondary elevation-1">
                              <i class="fas fa-user-circle fa-6x"></i>
                           </div>
                        @endif
                     </div>
                     <div class="card-footer">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <h4 class="widget-user-desc text-center">
                                 @if ($pengguna->role == 1)
                                    {{ 'Admin' }}
                                 @elseif ($pengguna->role == 2)
                                    {{ 'Guru' }}
                                 @elseif ($pengguna->role == 4)
                                    {{ 'Kepala Sekolah' }}
                                 @else
                                    {{ 'Tata Usaha' }}
                                 @endif
                              </h4>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <p class="text-muted text-center">
                                 @if (Cache::has('user-is-online-' . $pengguna->id))
                                    <small class="d-block text-center col-6 m-auto text-success">Aktif</small>
                                 @else
                                    <small class="d-block text-center col-6 m-auto text-secondary">Non-aktif</small>
                                 @endif
                                 <small>
                                    {{ \Carbon\Carbon::parse($pengguna->last_seen)->diffForHumans() }}
                                 </small>
                              </p>
                           </div>
                        </div>
                        <!-- /.row -->
                        <div class="d-flex justify-content-center mb-2 mt-0">
                           <a href="/pengguna" class="btn btn-secondary btn-sm mr-1">
                              <i class="fas fa-long-arrow-left"></i> Kembali</a>
                           <a href="/pengguna/{{ $pengguna->id }}/edit" class="btn btn-primary btn-sm mr-1"
                              {{ $pengguna->role == '1' ? 'hidden' : '' }}>
                              <i class="fas fa-edit"></i> Edit Profil</a>
                           @if (!Cache::has('user-is-online-' . $pengguna->id))
                              <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                 data-target="#modal-delete-{{ $pengguna->id }}"
                                 {{ $pengguna->role == '1' ? 'hidden' : '' }}>
                                 <i class="fas fa-trash"></i> Hapus</a>

                              <!-- Modal Delete -->
                              <div class="modal fade" id="modal-delete-{{ $pengguna->id }}" style="display: none;"
                                 aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content bg-warning">
                                       <div class="modal-header">
                                          <h4 class="modal-title">Hapus Data Pengguna</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p>Yakin hapus data pengguna {{ $profil->nama }}?</p>
                                       </div>
                                       <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-dark"
                                             data-dismiss="modal">Batal</button>
                                          <form method="POST" action="/pengguna/{{ $pengguna->id }}">
                                             @method('delete')
                                             @csrf
                                             <button onclick="return true" class="btn btn-danger">Hapus</button>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- /.modal-content -->
                                 </div>
                                 <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal delete-->
                           @endif

                        </div>
                     </div>
                     <!-- /.widget-user -->
                  </div>
               </div>
               <!-- /.col -->
               <div class="col-md-8">
                  <div class="card card-outline card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Data Pengguna</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body pb-1">
                        <strong><i class="fas fa-hashtag mr-1"></i> Nama Pengguna</strong>
                        <p class="text-muted">{{ $pengguna->username }}</p>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? 'Admin' : $profil->nama }}</p>
                        <hr>
                        <strong><i class="fas fa-key"></i> Kata Sandi</strong><br>
                        <p id="password_field" class="text-muted d-inline-flex mt-2 mb-0" style="">*******</p>
                        <a id="password_show_button" class="btn btn-info btn-xs mr-1 ml-4 mt-1 align-top"
                           data-toggle="modal" data-target="#modal-password">
                           <i class="fas fa-eye"></i> Lihat
                           {{-- <i class="fas fa-eye-slash"></i> Sembunyikan --}}
                        </a>
                        <a id="password_hide_button" class="btn btn-info btn-xs mr-1 ml-4" hidden>
                           <i class="fas fa-eye-slash"></i> Sembunyikan
                        </a>
                        <!-- Modal Password -->
                        <div class="modal fade modal-password" id="modal-password" style="display: none;"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-sm">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title mx-auto">Konfirmasi Admin</h4>
                                 </div>
                                 <div class="modal-body mx-auto pt-0">
                                    <div class="text-center">
                                       <svg width="120" height="120" viewBox="0 0 30 30" version="1.1"
                                          xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                                          <defs>
                                             <path
                                                d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z"
                                                id="outline"></path>
                                             <mask id="mask">
                                                <rect width="100%" height="100%" fill="white"></rect>
                                                <use xlink:href="#outline" id="lid" fill="black" />
                                             </mask>
                                          </defs>
                                          <g id="eye">
                                             <path
                                                d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z M14.9348958,22.081464 C11.2690863,22.081464 8.29688487,18.9510766 8.29688487,15.089434 C8.29688487,11.2277914 11.2690863,8.09740397 14.9348958,8.09740397 C18.6007053,8.09740397 21.5725924,11.2277914 21.5725924,15.089434 C21.5725924,18.9510766 18.6007053,22.081464 14.9348958,22.081464 L14.9348958,22.081464 Z M18.2535869,15.089434 C18.2535869,17.0200844 16.7673289,18.5857907 14.9348958,18.5857907 C13.1018339,18.5857907 11.6162048,17.0200844 11.6162048,15.089434 C11.6162048,13.1587835 13.1018339,11.593419 14.9348958,11.593419 C15.9253152,11.593419 14.3271242,14.3639878 14.9348958,15.089434 C15.451486,15.7055336 18.2535869,14.2027016 18.2535869,15.089434 L18.2535869,15.089434 Z"
                                                fill="#9ea6aa"></path>
                                             <use xlink:href="#outline" mask="url(#mask)" fill="#9ea6aa" />
                                          </g>
                                       </svg>
                                    </div>
                                    <input id="password_admin_input" class="form-control" type="password"
                                       placeholder="Kata sandi admin" autofocus>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <hr>
                        <strong><i class="far fa-venus-mars"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->gender }}</p>
                        <hr>
                        <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->email }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> NIP</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->nip }}</p>
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No. Telepon</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->no_hp }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $pengguna->role == '1' ? '-' : $profil->tempat_tinggal }}</p>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
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
   <script src="/jquery/jquery-3.6.0.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         $("#password_admin_input").on('keyup', function(e) {
            e.preventDefault();
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               url: "{{ url('is-admin') }}",
               method: 'post',
               data: {
                  password: $("#password_admin_input").val()
               },
               beforeSend: function() {},
               success: function(result) {
                  if (result.status) {
                     changeButton(true);
                     $("#password_admin_input").removeClass("is-invalid");
                     $("#modal-password").modal('hide');
                     $("#password_admin_input").val("");
                     hidePassword();
                  } else {
                     $("#password_admin_input").addClass("is-invalid");
                  }
               }
            });
         });
      });

      function hidePassword() {
         $("#password_hide_button").on('click', function(e) {
            changeButton(false);
         });
      }

      function changeButton(isPassShow) {
         if (isPassShow) {
            $("#password_field").text("{{ decrypt($pengguna->dec_password) }}");
            $("#password_show_button").attr("hidden", true);
            $("#password_hide_button").removeAttr("hidden");
         } else {
            $("#password_field").text("*******");
            $("#password_hide_button").attr("hidden", true);
            $("#password_show_button").removeAttr("hidden");
         }
      }
   </script>
@endsection
