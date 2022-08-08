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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <style>
      @page {
         margin: 2cm;
      }
   </style>
</head>

<body style="line-height: 1.3rem">
   <img src="{{ public_path('/img/logo-dinas-pendidikan.png') }}" alt="logo-dinas-pendidikan-jambi"
      style="position: absolute; width: 65px; height: auto; margin-left: 4px; margin-top: 8px">
   <img src="{{ public_path('/img/smanel-logo.png') }}" alt="logo-smanel" align="right"
      style="position: absolute; width: 70px; height: auto; margin-right: 3px;  margin-top: 8px">
   <table align="center" border="0" cellpadding="0"
      style="width: 100%; border-collapse: collapse; font-family: 'Times New Roman">
      <tbody>
         <tr>
            <td colspan="3">
               <div align="center" style="margin-left: 70px; margin-bottom: 0px; line-height: 28px">
                  <span style="font-family: 'Times New Roman'; font-size: larger;">
                     <b>PEMERINTAH PROVINSI JAMBI</b></span><br>
                  <span style="font-family: 'Times New Roman', Arial; font-size: larger;"><b>DINAS
                        PENDIDIKAN</b></span><br>
                  <span style="font-family: 'Times New Roman', Times, serif; font-size: x-large;"><b>SMA
                        NEGERI 5
                        MERANGIN</b></span><br>
               </div>
               <div align="center" style="margin-top: -4px; margin-bottom: -10px; margin-left: 70px">
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
            <td colspan="3">
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
            <td colspan="3">
               <table border="0" style="width: 100%; margin-bottom: 0.4cm; margin-top: 0.6cm">
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
            <td valign="top" colspan="3">
               <div align="left" style="margin-left: 380px">
                  <span style="font-size: medium">Renah Pamenang, {{ $tgl_keluar_pdf }}
                     <br></span>
                  {{-- <span style="font-size: medium;">Mengetahui</span> --}}
                  <span style="font-size: medium;">Kepala Sekolah, </span>
                  <div align="left" style="margin-top: 80px">
                     <span style="font-size: medium"><b> {{ $kepsek->nama }}</b></span>
                     <hr style="margin-left: 0px; margin-top: 0px; margin-bottom: 1px; height: 0.6px; background-color: black"
                        width="248px">
                     <span style="font-size: medium"><b> NIP. {{ $kepsek->nip }}</b></span>
                  </div>
               </div>
            </td>
         </tr>
      </tbody>
   </table>


   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
