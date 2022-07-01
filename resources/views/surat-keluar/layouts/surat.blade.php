<table align="center" border="0" cellpadding="0"
   style="width: 640px; border-collapse: collapse; margin-top: 2cm; padding-left: 2cm; margin-bottom: 2.5cm; margin-left: 2cm;font-family: 'Times New Roman';">
   <tbody>
      <tr>
         <td colspan="3">
            <img src="http://si-sekolah.test/img/logo-dinas-pendidikan.png" alt="logo-dinas-pendidikan-jambi"
               style=" width: 65px; height: auto; margin-left: 4px" class="rounded float-left position-absolute">
            <img src="http://si-sekolah.test/img/smanel-logo.png" alt="logo-smanel"
               style="width: 70px; height: auto; margin-left: 15cm" class="rounded  position-absolute">
            <div align="center" style=" margin-bottom: 0px; line-height: 25px" class="mx-auto">
               <span style="font-family: 'Times New Roman'; font-size: larger;">
                  <b>PEMERINTAH PROVINSI JAMBI</b></span><br>
               <span style="font-family: 'Times New Roman', Arial; font-size: larger;"><b>DINAS
                     PENDIDIKAN</b></span><br>
               <span style="font-family: 'Times New Roman', Times, serif; font-size: x-large;"><b>SMA
                     NEGERI 5
                     MERANGIN</b></span><br>
            </div>
            <div align="center" style="margin-top: -4px; margin-bottom: -20px">
               <span style="font-family: Arial, Helvetica, sans-serif; font-size: x-small;">Jl.
                  Pahlawan No. 1 Desa Meranti Kec. Renah Pamenang Kode Pos 37352</span><br>
            </div>
         </td>
      </tr>
      <tr>
         <td>
            <span style=" font-family: Arial, Helvetica, sans-serif; font-size: xx-small;">NSS.
               30.1.10.06.10.002</span>
         </td>
         <td colspan="2" align="right">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: xx-small;">NPSN.
               10505055</span>
         </td>
      </tr>
      <tr>
         <td colspan="3">
            <hr style="margin-top: 1px; margin-bottom: 2px; height: 1.5px; background-color: black">
         </td>
      </tr>
      <tr>
         <td valign="top" colspan="3">
            <div align="right" style="margin-top: 10px; margin-bottom: 5px">
               <span style="font-size: medium; margin-right: 10px;">{{ $tgl_hari }}</span>
            </div>
         </td>
      </tr>
      <tr>
         <td>
            <table border="0" cellpadding="1" style="width: 100%;">
               <tbody>
                  <tr>
                     <td width="60"><span style="font-size: medium;">No</span></td>
                     <td width="8"><span style="font-size: medium;">:</span></td>
                     <td width="200"><span
                           style="font-size: medium;">{{ "$nomor/$kode_tujuan/$instansi_asal/$bulan-$tahun" }}</span>
                     </td>
                  </tr>
                  <tr>
                     <td><span style="font-size: medium;">Lampiran</span></td>
                     <td><span style="font-size: medium;">:</span></td>
                     <td><span style="font-size: medium;">{{ $lampiran }}</span></td>
                  </tr>
                  <tr>
                     <td><span style="font-size: medium;">Perihal</span></td>
                     <td><span style="font-size: medium;">:</span></td>
                     <td><span style="font-size: medium;">{{ $perihal }}</span></td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td>
            <table border="0" style="width: 100%; margin-bottom: 1cm">
               <tbody>
                  <tr>
                     <td width="140"><span style="font-size: medium;">Kepada Yth</span>
                     </td>
                     <td width="11">
                     </td>
                     <td width="140"></td>
                  </tr>
                  <tr>
                     <td><span style="font-size: medium">{{ $individu_tujuan }}</span>
                     </td>
                     <td></td>
                     <td>
                     </td>
                  </tr>
                  <tr>
                     <td><span style="font-size: medium;">di-</span></td>
                     <td></td>
                     <td>
                     </td>
                  </tr>
                  <tr>
                     <td><span style="font-size: medium">{{ $tujuan }}</span></td>
                     <td></td>
                     <td>
                     </td>
                  </tr><br>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="3" valign="top">
            <div align="justify" style="min-height: 150px; margin-bottom: 2rem">
               <span style="font-size: medium;">{!! $isi_surat !!}</span>
            </div>
         </td>
      </tr>
      <tr>
         {{-- <td>
                                    <div align="center">
                                       <span style="font-size: medium;">Sekertaris,</span>
                                    </div>
                                    <div align="center">
                                       <span style="font-size: medium;">Ai komala sari </span>
                                    </div>
                                 </td> --}}
         <td width="380px"></td>
         <td valign="top">
            <div align="left" style="margin-top: 1.2rem;">
               <span style="font-size: medium">Renah Pamenang, {{ $tgl_keluar }}
                  <br></span>
               {{-- <span style="font-size: medium;">Mengetahui</span> --}}
               <span style="font-size: medium;">Kepala Sekolah, </span>
               <div align="left" style="margin-top: 80px">
                  <span style="font-size: medium"><b> HENANG PRIYANTO, S.Pd., M.Pd.</b></span>
                  <hr style="margin-top: 0px; margin-bottom: 1px; height: 1px; background-color: black" width="250px"
                     align="left">
                  <span style="font-size: medium"><b> NIP. 198302102005011005</b></span>
               </div>
         </td>
      </tr>
   </tbody>
</table>
