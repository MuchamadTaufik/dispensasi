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
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Waktu Keluar</th>
                        <th>Waktu Kembali</th>
                        <th>Alasan</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Validasi</th>
                        <th>Timer</th>
                        <th>Cetak</th>
                        <th>Action</th>
                    </tr>
                </thead>
            
                <tbody>
                    @php
                        $dispensasisKeluar = $dispensasisKeluar->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp
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
                            @if($dispensasi->status_id === 1)
                                <label class="label text-warning">{{ $dispensasi->status->name }}</label>
                            @elseif($dispensasi->status_id === 2)
                                <label class="label text-info">{{ $dispensasi->status->name }}</label>
                            @else
                                <label class="label text-success">{{ $dispensasi->status->name }}</label>
                            @endif
                        </td>                                    
                        <td>
                            @if($dispensasi->status_id === 1)
                                <div class="btn-group">
                                    <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}" class="btn btn-success btn-sm">
                                        Approve
                                    </a>
                                </div>
                                <div id="rejectForm{{ $dispensasi->id }}" class="hidden" style="margin-top: 10px;">
                                    <form action="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}" method="post">
                                        @csrf
                                        <label for="pesan_reject">Pesan Reject:</label>
                                        <textarea name="pesan_reject" id="pesan_reject" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </div>
                            @endif
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
                        <td>
                            @if($dispensasi->status_id === 2)
                                <a href="{{ url('/dashboard-admin/done/'.$dispensasi->id) }}" class="btn btn-success btn-sm">
                                    Done
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
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
                    @php
                        $dispensasisMasuk = $dispensasisMasuk->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp
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
                                @if($dispensasi->status_id === 1)
                                    <label class="label text-warning">{{ $dispensasi->status->name }}</label>
                                @elseif($dispensasi->status_id === 2)
                                    <label class="label text-success">{{ $dispensasi->status->name }}</label>
                                @else
                                    <label class="label text-danger">{{ $dispensasi->status_id ? $dispensasi->status->name : 'Unknown Status' }}</label>
                                @endif
                            </td>                            
                            <td>
                            @if($dispensasi->status_id === 1)
                                <div class="btn-group">
                                    <a href="{{ url('/dashboard-admin/approved/'.$dispensasi->id) }}" class="btn btn-success btn-sm">
                                        Approve
                                    </a>
                                </div>
                                <div id="rejectForm{{ $dispensasi->id }}" class="hidden" style="margin-top: 10px;">
                                    <form action="{{ url('/dashboard-admin/rejected/'.$dispensasi->id) }}" method="post">
                                        @csrf
                                        <label for="pesan_reject">Pesan Reject:</label>
                                        <textarea name="pesan_reject" id="pesan_reject" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </div>
                            @endif
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
            </table>
        </div>
    </div>
</div>

<script>
    @foreach ($dispensasisKeluar as $dispensasi)
        var waktuPersetujuan{{ $dispensasi->id }} = new Date("{{ $dispensasi->waktu_persetujuan }}").getTime();
        var durasiTimer{{ $dispensasi->id }} = {{ $dispensasi->durasi_timer }};
        var status{{ $dispensasi->id }} = "{{ $dispensasi->status_id }}";
        var waktuSelesai{{ $dispensasi->id }} = new Date("{{ $dispensasi->waktu_selesai }}").getTime();
        var waktuKembali{{ $dispensasi->id }} = new Date("{{ $dispensasi->waktu_kembali }}").getTime();

        var timer{{ $dispensasi->id }} = setInterval(function () {
            var now = new Date().getTime();
            var distance = waktuPersetujuan{{ $dispensasi->id }} + (durasiTimer{{ $dispensasi->id }} * 1000) - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var timerElement = document.getElementById("timer{{ $dispensasi->id }}");
            var keterlambatanElement = document.getElementById("keterlambatan{{ $dispensasi->id }}");

            if (status{{ $dispensasi->id }} == 4) {
                // Dispensation is completed
                clearInterval(timer{{ $dispensasi->id }});
                var waktuSelesaiFormatted = new Date(waktuSelesai{{ $dispensasi->id }}).toLocaleString();
                timerElement.innerHTML = "Selesai: " + waktuSelesaiFormatted;

                // Check if waktu_selesai exceeds waktu_kembali
                if (waktuSelesai{{ $dispensasi->id }} > waktuKembali{{ $dispensasi->id }}) {
                    timerElement.parentElement.style.backgroundColor = "red";
                }
                
                keterlambatanElement.innerHTML = ""; // Clear keterlambatan display
            } else if (distance > 0) {
                // Dispensation is ongoing
                timerElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                keterlambatanElement.innerHTML = ""; // Clear keterlambatan display
            } else {
                // Dispensation is late
                clearInterval(timer{{ $dispensasi->id }});
                var keterlambatan = Math.abs(now - waktuKembali{{ $dispensasi->id }});
                var terlambatDays = Math.floor(keterlambatan / (1000 * 60 * 60 * 24));
                var terlambatHours = Math.floor((keterlambatan % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var terlambatMinutes = Math.floor((keterlambatan % (1000 * 60 * 60)) / (1000 * 60));
                var terlambatSeconds = Math.floor((keterlambatan % (1000 * 60)) / 1000);

                timerElement.innerHTML = "Terlambat: " + terlambatDays + "d " + terlambatHours + "h " + terlambatMinutes + "m " + terlambatSeconds + "s ";
                keterlambatanElement.innerHTML = ""; // Clear keterlambatan display

                var tableRow = document.querySelectorAll("#dataTable tr")[{{ $loop->index + 1 }}];
                tableRow.style.backgroundColor = "red";
            }
        }, 1000);
    @endforeach



    function showRejectForm(dispensasiId) {
        var rejectForm = document.getElementById('rejectForm' + dispensasiId);
        if (rejectForm.classList.contains('hidden')) {
            rejectForm.classList.remove('hidden');
        } else {
            rejectForm.classList.add('hidden');
        }
    }
</script>

@endsection
