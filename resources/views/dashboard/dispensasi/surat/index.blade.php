<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pernyataan</title>

    <style>
        @page {
            size: 5.7in 6.5in;
        }

        #judul{
            text-align: center;
        }

        #halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }
    </style>
</head>
<body>
    <div id="halaman">
        <table width="300">
            <center>
                <font size="5">SURAT KETERANGAN DISPENSASI</font> <br>
                <font size="4">MAN 2 KOTA BANDUNG</font>
            </center>
            <hr style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
        </table>

        <table>
            <table width="350">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Momon Sudarma</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Kepala Sekolah</td>
                </tr>
            </table><br>
            <tr>
                <td>Menyatakan dengan sebenarnya bahwa :</td>
            </tr>
        </table>

        <table width="300">
            @if ($dispensasis && count($dispensasis) > 0)
                @php $dispensasi = $dispensasis[0]; @endphp
                @if ((auth()->user()->role_id === 2 || auth()->user()->id === $dispensasi->user_id) && $dispensasi->status_id === 4 || $dispensasi->status_id === 2 )
                    <tr>
                        <td>Nomor Induk</td>
                        <td>:</td>
                        <td>{{ $dispensasi->user->nomor_induk }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $dispensasi->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $dispensasi->user->kelas->name }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{ $dispensasi->alasan->name }}</td>
                    </tr>
        
                    {{-- Tampilkan waktu keluar dan waktu kembali untuk izin keluar (ID 2) --}}
                    @if ($dispensasi->type_id === 2)
                        <tr>
                            <td>Waktu Keluar</td>
                            <td>:</td>
                            <td>{{ $dispensasi->waktu_keluar }}</td>
                        </tr>
                        <tr>
                            <td>Waktu Kembali</td>
                            <td>:</td>
                            <td>{{ $dispensasi->waktu_kembali }}</td>
                        </tr>
                    @endif
        
                    {{-- Tampilkan waktu masuk untuk izin masuk (ID 1) --}}
                    @if ($dispensasi->type_id === 1)
                        <tr>
                            <td>Waktu Masuk</td>
                            <td>:</td>
                            <td>{{ $dispensasi->waktu_masuk }}</td>
                        </tr>
                    @endif
        
                    <tr>
                        <td>Type</td>
                        <td>:</td>
                        <td>{{ $dispensasi->type->name }}</td>
                    </tr>
                @else
                    <!-- Tampilkan pesan untuk akses yang tidak sah -->
                    <tr>
                        <td colspan="3">Unauthorized access to dispensasi data.</td>
                    </tr>
                @endif
            @else
                <!-- Tampilkan pesan jika tidak ada data dispensasi -->
                <tr>
                    <td colspan="3">No dispensasi data available.</td>
                </tr>
            @endif
        </table><br>
        
        
        
        
        

        <table>
            <tr>
                <td>Adalah benar telah melakukan Dispensasi</td>
            </tr>
        </table><br>

        <div style="width:30%; text-align: left; float:right;">
        </div><br>
    </div>
</body>
</html>