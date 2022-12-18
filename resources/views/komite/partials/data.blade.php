<div class="row">
   <div class="col-3 px-0">
      <table class="table table-responsive table-borderless" style="white-space: nowrap">
         <thead>
            <tr>
               <th class="text-center align-middle pl-1" style="width: 3%">No.</th>
               <th class="align-middle" style="padding-left: 18%">Nama</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($komite as $ko)
               <tr>
                  <td class="text-center pl-0">{{ $loop->iteration }}</td>
                  <td style="height: 50px" class="pl-0">{{ $ko->siswa->nama }}</td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <div class="container-fluid col-9 px-0">
      <table class="table table-responsive table-borderless">
         <thead>
            <tr class="d-flex">
               <th class="col-2 text-center">Daftar Ulang</th>
               @if ($semester == 'Genap')
                  <th class="col-2 text-center">Komite S1</th>
                  <th class="col-2 text-center">Januari</th>
                  <th class="col-2 text-center">Februari</th>
                  <th class="col-2 text-center">Maret</th>
                  <th class="col-2 text-center">April</th>
                  <th class="col-2 text-center">Mei</th>
                  <th class="col-2 text-center">Juni</th>
               @else
                  <th class="col-2 text-center">Juli</th>
                  <th class="col-2 text-center">Agustus</th>
                  <th class="col-2 text-center">September</th>
                  <th class="col-2 text-center">Oktober</th>
                  <th class="col-2 text-center">November</th>
                  <th class="col-2 text-center">Desember</th>
               @endif
               <th class="col-6 text-center">Kartu Komite (*maks. 10MB)</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($komite as $ko)
               <tr class="d-flex">
                  <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                     <div class="pl-0">
                        <input type="text" oninput="warnaStatus()"
                           class="form-control data daftar_ulang_{{ $ko->id }}"
                           name="daftar_ulang_{{ $ko->id }}" id="rupiah_{{ $ko->id }}"
                           value="{{ $ko->daftar_ulang <= 0 ? 'Lunas' : "$ko->daftar_ulang" }}">
                     </div>
                  </td>
                  @if ($semester == 'Genap')
                     <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                        <div class="pl-0">
                           <input type="text" class="form-control data" name="komite1_{{ $ko->id }}"
                              id="komite1_{{ $ko->id }}" value="{{ $ko->komite_1 }}" readonly required>
                        </div>
                     </td>
                  @endif
                  @for ($i = $bln_awal; $i <= $bln_awal + 5; $i++)
                     <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                        <div class="pl-0">
                           <select class="form-control data" name="komite_{{ $ko->id }}_{{ $i }}"
                              id="komite_{{ $ko->id }}_{{ $i }}" onchange="warnaStatus()" required>
                              @if ($ko->$i == 'Belum Lunas')
                                 <option class="" value="Belum Lunas" selected>Belum Lunas</option>
                                 <option value="Lunas">Lunas</option>
                              @elseif ($ko->$i == 'Lunas')
                                 <option value="Belum Lunas">Belum Lunas</option>
                                 <option value="Lunas" selected>Lunas</option>
                              @else
                                 <option value="" selected hidden disabled>-- Pilih Status --
                                 </option>
                                 <option value="Belum Lunas">Belum Lunas</option>
                                 <option value="Lunas">Lunas</option>
                              @endif
                           </select>
                        </div>
                     </td>
                  @endfor
                  <td class="col-6 px-1 py-1 d-inline-flex" style="margin-bottom: 2px; margin-top: 2px">
                     <div class="col-10 custom-file">
                        <input type="file"
                           class="custom-file-input @error('kartu_{{ $ko->id }}') is-invalid @enderror"
                           id="kartu_{{ $ko->id }}" name="kartu_{{ $ko->id }}">
                        <label class="custom-file-label" for="kartu_{{ $ko->id }}" data-browse="Pilih">Unggah
                           kartu
                           komite (.jpg, .png, .jpeg)</label>
                        @error('kartu_{{ $ko->id }}')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                     <div class="col-2">
                        <a class="btn btn-info btn-sm mt-1" data-toggle="modal"
                           data-target="#modal-kartu-{{ $ko->id }}">
                           <i class="fas fa-eye"></i></a>

                        <!-- Modal View Kartu Komite-->
                        <div class="modal fade" id="modal-kartu-{{ $ko->id }}" style="display: none;"
                           aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header text-center">
                                    <h4 class="modal-title">Kartu Komite {{ $ko->siswa->nama }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">×</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    @if ($ko->kartu != null)
                                       <img class="col-12" src="/storage/{{ $ko->kartu }}"
                                          alt="kartu-komite-{{ $ko->siswa->nama }}">
                                    @else
                                       <p>Kartu komite belum diunggah!</p>
                                    @endif
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal view kartu komite -->
                     </div>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   @can('tata-usaha')
      <a id="button_simpan" class="d-block col-auto btn btn-primary ml-auto mr-3">Simpan</a>
   @endcan
</div>
