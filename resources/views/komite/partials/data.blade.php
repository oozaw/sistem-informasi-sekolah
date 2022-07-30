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
               @if ($semester == 'Ganjil')
                  <th class="col-2 text-center">Januari</th>
                  <th class="col-2 text-center">Februari</th>
                  <th class="col-2 text-center">Maret</th>
                  <th class="col-2 text-center">April</th>
                  <th class="col-2 text-center">Mei</th>
                  <th class="col-2 text-center">Juni</th>
               @else
                  <th class="col-2 text-center">Komite S1</th>
                  <th class="col-2 text-center">Juli</th>
                  <th class="col-2 text-center">Agustus</th>
                  <th class="col-2 text-center">September</th>
                  <th class="col-2 text-center">Oktober</th>
                  <th class="col-2 text-center">November</th>
                  <th class="col-2 text-center">Desember</th>
               @endif
            </tr>
         </thead>
         <tbody>
            @foreach ($komite as $ko)
               <tr class="d-flex">
                  <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                     <div class="pl-0">
                        <input type="text" oninput="warnaStatus()"
                           class="form-control daftar_ulang_{{ $ko->id }}" name="daftar_ulang_{{ $ko->id }}"
                           id="rupiah_{{ $ko->id }}"
                           value="{{ $ko->daftar_ulang <= 0 ? 'Lunas' : "Rp. $ko->daftar_ulang" }}">
                     </div>
                  </td>
                  @if ($semester == 'Genap')
                     <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                        <div class="pl-0">
                           <select class="form-control" name="komite1_{{ $ko->id }}"
                              id="komite1_{{ $ko->id }}" onchange="warnaStatus()" required>
                              <option class="" value="Belum Lunas" selected>Belum Lunas</option>
                              <option value="Lunas">Lunas</option>
                           </select>
                        </div>
                     </td>
                  @endif
                  @for ($i = $bln_awal; $i <= $bln_awal + 5; $i++)
                     <td class="col-2 px-1 py-1" style="margin-bottom: 2px; margin-top: 2px">
                        <div class="pl-0">
                           <select class="form-control" name="komite_{{ $ko->id }}_{{ $i }}"
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
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <a href="" id="button_simpan" class="d-block col-auto btn btn-primary ml-auto mr-3">Simpan</a>
</div>
