@extends('layouts.main')

@section('container')

<h1 class="h3 mb-2 text-gray-800">Tabel Dispensasi</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Dispensasi Keluar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Waktu Keluar</th>
                        <th>Waktu Kembali</th>
                        <th>Alasan</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Timer</th>
                        <th>Cetak</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($dispensasisKeluar as $dispensasi)
                    <tr>
                        <!-- Populate rows with data (Same as before) -->
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $dispensasi->user->name }}</td>
                        <td>{{ $dispensasi->type->name }}</td>
                        <td>{{ $dispensasi->waktu_keluar }}</td>
                        <td>{{ $dispensasi->waktu_kembali }}</td>
                        <td>{{ $dispensasi->alasan->name }}</td>
                        <td>{{ $dispensasi->deskripsi }}</td>
                        <td>
                            @if ($dispensasi->bukti)
                                <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M8 0a.5.5 0 0 1 .5.5v9.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 10.293V.5A.5.5 0 0 1 8 0z"/>
                                        <path d="M0 12.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h16a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5H0zM5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5z"/>
                                    </svg>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($dispensasi->status_id == 1)
                                <label class="label label-warning">{{ $dispensasi->status->name }}</label>
                            @elseif($dispensasi->status_id == 2)
                                <label class="label label-success">{{ $dispensasi->status->name }}</label>
                            @else
                                <label class="label label-danger">{{ $dispensasi->status_id ? $dispensasi->status->name : 'Unknown Status' }}</label>
                            @endif
                        </td>                                    
                        <td>
                            @if($dispensasi->status_id != 2) <!-- Only show approve action if status is not 'Approved' -->
                                <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </a>
                            @endif
                            <a href="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <div id="timer{{ $dispensasi->id }}"></div>
                            <div id="keterlambatan{{ $dispensasi->id }}"></div>
                        </td>
                        <td>
                            <a href="{{ route('dispensasi.show', ['dispensasi' => $dispensasi->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                            </a>
                            <a href="{{ route('download-pdf', $dispensasi->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M8 0a.5.5 0 0 1 .5.5v9.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 10.293V.5A.5.5 0 0 1 8 0z"/>
                                    <path d="M0 12.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h16a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5H0zM5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @if(count($dispensasisKeluar) > 5)
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Waktu Keluar</th>
                            <th>Waktu Kembali</th>
                            <th>Alasan</th>
                            <th>Deskripsi</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Timer</th>
                            <th>Cetak</th>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Dispensasi Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Waktu Masuk</th>
                        <th>Alasan</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Cetak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dispensasisMasuk as $dispensasi)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dispensasi->user->name }}</td>
                            <td>{{ $dispensasi->type->name }}</td>
                            <td>{{ $dispensasi->waktu_masuk }}</td>
                            <td>{{ $dispensasi->alasan->name }}</td>
                            <td>{{ $dispensasi->deskripsi }}</td>
                            <td>
                                @if ($dispensasi->bukti)
                                        <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path d="M8 0a.5.5 0 0 1 .5.5v9.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 10.293V.5A.5.5 0 0 1 8 0z"/>
                                                <path d="M0 12.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h16a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5H0zM5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5z"/>
                                            </svg>
                                        </a>
                                @endif
                            </td>
                            <td>
                                @if($dispensasi->status_id == 1)
                                    <label class="label label-warning">{{ $dispensasi->status->name }}</label>
                                @elseif($dispensasi->status_id == 2)
                                    <label class="label label-success">{{ $dispensasi->status->name }}</label>
                                @else
                                    <label class="label label-danger">{{ $dispensasi->status_id ? $dispensasi->status->name : 'Unknown Status' }}</label>
                                @endif
                            </td>                            
                            <td>
                                @if($dispensasi->status_id != 2) <!-- Only show approve action if status is not 'Approved' -->
                                    <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('dispensasi.show', ['dispensasi' => $dispensasi->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('download-pdf', $dispensasi->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M8 0a.5.5 0 0 1 .5.5v9.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 10.293V.5A.5.5 0 0 1 8 0z"/>
                                        <path d="M0 12.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h16a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5H0zM5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @if(count($dispensasisMasuk) > 5)
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Waktu Keluar</th>
                            <th>Waktu Kembali</th>
                            <th>Alasan</th>
                            <th>Deskripsi</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Timer</th>
                            <th>Cetak</th>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

<script>
    @foreach ($dispensasisKeluar as $dispensasi)
        var waktuPersetujuan{{ $dispensasi->id }} = new Date("{{ $dispensasi->waktu_persetujuan }}").getTime();
        var durasiTimer{{ $dispensasi->id }} = {{ $dispensasi->durasi_timer }};
        var timer{{ $dispensasi->id }} = setInterval(function() {
            var now = new Date().getTime();
            var distance = waktuPersetujuan{{ $dispensasi->id }} + (durasiTimer{{ $dispensasi->id }} * 1000) - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer{{ $dispensasi->id }}").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(timer{{ $dispensasi->id }});
                document.getElementById("timer{{ $dispensasi->id }}").innerHTML = "EXPIRED";

                // Menghitung keterlambatan
                var waktuKembali = new Date("{{ $dispensasi->waktu_kembali }}").getTime();
                var keterlambatan = Math.abs(now - waktuKembali);
                var terlambatDays = Math.floor(keterlambatan / (1000 * 60 * 60 * 24));
                var terlambatHours = Math.floor((keterlambatan % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var terlambatMinutes = Math.floor((keterlambatan % (1000 * 60 * 60)) / (1000 * 60));
                var terlambatSeconds = Math.floor((keterlambatan % (1000 * 60)) / 1000);

                document.getElementById("keterlambatan{{ $dispensasi->id }}").innerHTML = "Terlambat: " + terlambatDays + "d " + terlambatHours + "h " + terlambatMinutes + "m " + terlambatSeconds + "s";
                
                document.querySelectorAll("#datatablesSimpleKeluar tr")[{{ $loop->index + 1 }}].style.backgroundColor = "red";
            }
        }, 1000);
    @endforeach
</script>




@endsection
