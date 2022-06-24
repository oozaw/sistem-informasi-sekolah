<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $title }}</title>

   {{-- Icon --}}
   <link rel="icon" type="image/gif/png" href="/img/smanel-logo.png">
   <!-- Theme style -->
   <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

<body>
   <img src="http://si-sekolah.test/img/logo-dinas-pendidikan.png" alt="logo-dinas-pendidikan-jambi"
      style="position: absolute; width: 65px; height: auto; margin-left: 4px">
   <img src="http://si-sekolah.test/img/smanel-logo.png" alt="logo-smanel" align="right"
      style="position: absolute; width: 70px; height: auto; margin-right: 2px">
   <table align="center" border="1" cellpadding="0" style="width: 100%; border-collapse: collapse">
      <tbody>
         <tr>
            <td colspan="3">
               <div align="center" style="margin-left: 65px; margin-bottom: -10px">
                  <span style="font-family: 'Times New Roman'; font-size: large;">
                     <b>PEMERINTAH PROVINSI JAMBI</b></span><br>
                  <span style="font-family: Arial; font-size: large;"><b>DINAS PENDIDIKAN</b></span><br>
                  <span style="font-family: 'Times New Roman', Times, serif; font-size: large;"><b>SMA NEGERI 5
                        MERANGIN</b></span><br>
                  <span style="font-family: Arial, Helvetica, sans-serif; font-size: x-small">Jl.
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
               <hr style="margin-top: 1px; margin-bottom: 2px; height: 1px; background-color: black">
            </td>
         </tr>
         <tr>
            <td>
               <table border="0" cellpadding="1" style="width: 100%;">
                  <tbody>
                     <tr>
                        <td width="60"><span style="font-size: small;">No</span></td>
                        <td width="8"><span style="font-size: small;">:</span></td>
                        <td width="200"><span
                              style="font-size: small;">{{ "$nomor/$kode_tujuan/$instansi_asal/$bulan-$tahun" }}</span>
                        </td>
                     </tr>
                     <tr>
                        <td><span style="font-size: small;">Lampiran</span></td>
                        <td><span style="font-size: small;">:</span></td>
                        <td><span style="font-size: small;">{{ $lampiran }}</span></td>
                     </tr>
                     <tr>
                        <td><span style="font-size: small;">Perihal</span></td>
                        <td><span style="font-size: small;">:</span></td>
                        <td><span style="font-size: small;">{{ $perihal }}</span></td>
                     </tr>
                  </tbody>
               </table>
            </td>
            <td valign="top" colspan="2">
               <div align="right">
                  <span style="font-size: small;">{{ $tgl_keluar }}</span>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <table border="0" style="width: 239px;">
                  <tbody>
                     <tr>
                        <td width="98"><span style="font-size: small;"><br>Kepada Yth</span></td>
                        <td width="11">
                        </td>
                        <td width="140"></td>
                     </tr>
                     <tr>
                        <td><span style="font-size: small;">{{ $individu_tujuan }}</span></td>
                        <td></td>
                        <td>
                        </td>
                     </tr>
                     <tr>
                        <td><span style="font-size: small;">di-</span></td>
                        <td></td>
                        <td>
                        </td>
                     </tr>
                     <tr>
                        <td><span style="font-size: small;">{{ $tujuan }}</span></td>
                        <td></td>
                        <td>
                        </td>
                     </tr><br>
                  </tbody>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="3" height="270" valign="top">
               <div align="justify" style="margin-left: 3px">
                  <span style="font-size: small;">Dengan hormat,<br>
                     Sehubungan akan diadakannya Praktek kerja industri
                     (Prakerin) siswa kelas XI maka kami selaku pihak
                     sekolah akan membicarakan mengenai
                     pelaksanaan prakerin yang akan dilaksanakan pada :</span>
                  <table border="0" style="width: 352px;">
                     <tbody>
                        <tr>
                           <td width="80"><span style="font-size: small;">hari/tanggal</span></td>
                           <td width="10"><span style="font-size: small;">:</span></td>
                           <td width="248"><span style="font-size: small;">Rabu, 11 mei 2011</span></td>
                        </tr>
                        <tr>
                           <td><span style="font-size: small;">waktu</span></td>
                           <td><span style="font-size: small;">:</span></td>
                           <td><span style="font-size: small;">08.00 - selesai</span></td>
                        </tr>
                        <tr>
                           <td><span style="font-size: small;">tempat</span></td>
                           <td><span style="font-size: small;">:</span></td>
                           <td><span style="font-size: small;">Aula SMK Informatika Sumedang </span></td>
                        </tr>
                     </tbody>
                  </table>
                  <div align="justify">
                     <span style="font-size: small;">

                        Demikian surat ini kami sampaikan, kami harap ibu/bapa dapat menghadiri rapat ini. sekian dan
                        terima kasih.</span>
                  </div>
               </div>
               <div align="right">
                  <span style="font-size: small;">Mengetahui</span>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <div align="center">
                  <span style="font-size: small;">Sekertaris,</span>
               </div>
               <div align="center">

               </div>
               <div align="center">
                  <span style="font-size: small;">Ai komala sari </span>
               </div>
            </td>
            <td></td>
            <td valign="top">
               <div align="center">
                  <span style="font-size: small;">Kepala Sekolah, </span>
               </div>
               <div align="center">

               </div>
               <div align="center">
                  <span style="font-size: small;">E.Sulyati Dra,M.pd.</span>
               </div>
            </td>
         </tr>
      </tbody>
   </table>
</body>

</html>
