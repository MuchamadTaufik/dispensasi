<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        /* Set lebar tabel sesuai kebutuhan */
        table {
            width: 100%; /* Sesuaikan dengan lebar halaman PDF */
        }
        /* Set lebar kolom agar sesuai dengan konten */
        table th,
        table td {
            width: auto; /* Sesuaikan dengan konten */
            font-size: 8px; /* Atur ukuran font */
        }
    </style>
</head>
<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Dispensasi Izin Pulang Sekolah, pada Tahun ({{ $selectedYear }})</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Induk</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Alasan</th>
                        <th>Waktu Keluar</th>
                        <th>Batas Waktu Kembali</th>
                        <th>Waktu Persetujuan</th>
                        <th>Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dispensasis = $dispensasis->where('status_id', 4)->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp
                    @foreach ($dispensasis as $dispensasi)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $dispensasi->user->nomor_induk }}</td>
                        <td>{{ $dispensasi->user->name }}</td>
                        <td>{{ $dispensasi->user->kelas->name }}</td>
                        <td>{{ $dispensasi->alasan->name }}</td>
                        <td>{{ $dispensasi->waktu_keluar }}</td>
                        <td>{{ $dispensasi->waktu_kembali }}</td>
                        <td>{{ $dispensasi->waktu_persetujuan }}</td>
                        <td class="{{ $dispensasi->waktu_selesai > $dispensasi->waktu_kembali ? 'text-danger' : '' }}">{{ $dispensasi->waktu_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
