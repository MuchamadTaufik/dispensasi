@extends('layouts.main')

@section('container')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Dispensasi Keluar Table -->
            <div class="card mb-4 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dispensasi Keluar
                </div>
                <div class="card-body">
                    <table id="datatablesSimpleKeluar">
                        <!-- Table Header and Footer (Same as before) -->
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
                            </tr>
                        </thead>
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
                            </tr>
                        </tfoot>
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
                                    
                                    @if($dispensasi->status_id == 1)
                                        <td>
                                            <label class="label label-warning">{{ $dispensasi->status->name }}</label>
                                        </td>
                                    @elseif($dispensasi->status_id == 2)
                                        <td>
                                            <label class="label label-success">{{ $dispensasi->status->name }}</label>
                                        </td>
                                    @else
                                        <td>
                                            <label class="label label-danger">{{ $dispensasi->status_id ? $dispensasi->status->name : 'Unknown Status' }}</label>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td colspan="9">
                                        <div id="timer{{ $dispensasi->id }}"></div>
                                        <div id="keterlambatan{{ $dispensasi->id }}"></div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dispensasi Masuk Table -->
            <div class="card mb-4 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dispensasi Masuk
                </div>
                <div class="card-body">
                    <table id="datatablesSimpleMasuk">
                        <!-- Table Header and Footer (Similar to above) -->
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
                            </tr>
                        </thead>
                        <tfoot>
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
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dispensasisMasuk as $dispensasi)
                                <tr>
                                    <!-- Populate rows with data (Similar to above) -->
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
                                    
                                    @if($dispensasi->status_id == 1)
                                        <td>
                                            <label class="label label-warning">{{ $dispensasi->status->name }}</label>
                                        </td>
                                    @elseif($dispensasi->status_id == 2)
                                        <td>
                                            <label class="label label-success">{{ $dispensasi->status->name }}</label>
                                        </td>
                                    @else
                                        <td>
                                            <label class="label label-danger">{{ $dispensasi->status_id ? $dispensasi->status->name : 'Unknown Status' }}</label>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
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
