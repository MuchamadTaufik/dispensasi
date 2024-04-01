@extends('layouts.main')

@section('container')

<h1 class="h3 mb-2 text-gray-800">Tabel Dispensasi</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Dispensasi Izin Masuk ke Sekolah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>Nomor Induk</th>
                        <th>Name</th>
                        <th>Kelas</th>
                        <th>Type</th>
                        <th>Alasan</th>
                        <th>Waktu Masuk</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dispensasisMasuk as $dispensasi)
                        @if ($dispensasi->type_id === 1 && $dispensasi->status_id === 1)
                        <tr>
                            <td>{{ $dispensasi->user->nomor_induk }}</td>
                            <td>{{ $dispensasi->user->name }}</td>
                            <td>{{ $dispensasi->user->kelas->name }}</td>
                            <td>{{ $dispensasi->type->name }}</td>
                            <td>{{ $dispensasi->alasan->name }}</td>
                            <td>{{ $dispensasi->waktu_masuk }}</td>
                            <td>{{ $dispensasi->deskripsi }}</td>
                            <td>
                                @if ($dispensasi->bukti)
                                    <a href="{{ asset('storage/' . $dispensasi->bukti) }}" target="_blank"><span data-feather="eye"></span></a>
                                    <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download target="_blank"><span data-feather="download"></span></a>
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
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Dispensasi Izin Pulang Sekolah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>Nomor Induk</th>
                        <th>Name</th>
                        <th>Kelas</th>
                        <th>Type</th>
                        <th>Alasan</th>
                        <th>Waktu Keluar</th>
                        <th>Batas Waktu Kembali</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Validasi</th>
                        <th>Timer</th>
                        <th>Action</th>
                        <th>Cetak</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($dispensasisKeluar as $dispensasi)
                        @if ($dispensasi->type_id === 2 && ($dispensasi->status_id === 1 || $dispensasi->status_id === 2))
                        <tr>
                            <td>{{ $dispensasi->user->nomor_induk }}</td>
                            <td>{{ $dispensasi->user->name }}</td>
                            <td>{{ $dispensasi->user->kelas->name }}</td>
                            <td>{{ $dispensasi->type->name }}</td>
                            <td>{{ $dispensasi->alasan->name }}</td>
                            <td>{{ $dispensasi->waktu_keluar }}</td>
                            <td>{{ $dispensasi->waktu_kembali }}</td>
                            <td>{{ $dispensasi->deskripsi }}</td>
                            <td>
                                @if ($dispensasi->bukti)
                                    <a href="{{ asset('storage/' . $dispensasi->bukti) }}" target="_blank"><span data-feather="eye"></span></a>
                                    <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download target="_blank"><span data-feather="download"></span></a>
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
                                @if($dispensasi->status_id === 2)
                                    <a href="{{ url('/dashboard-admin/done/'.$dispensasi->id) }}" class="btn btn-success btn-sm">
                                        Done
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dispensasi.show', ['dispensasi' => $dispensasi->id]) }}"target="_blank"><span data-feather="eye"></a>
                                <a href="{{ route('download-pdf', $dispensasi->id) }}" target="_blank"><span data-feather="download"></a>
                            </td>
                        </tr>
                        @endif
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

            if (status{{ $dispensasi->id }} == 2) {
                // Dispensation is Accept
                if (distance > 0) {
                    timerElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                    keterlambatanElement.innerHTML = ""; // Clear keterlambatan display
                } else {
                    clearInterval(timer{{ $dispensasi->id }});
                    var keterlambatan = Math.abs(now - waktuKembali{{ $dispensasi->id }});
                    var terlambatDays = Math.floor(keterlambatan / (1000 * 60 * 60 * 24));
                    var terlambatHours = Math.floor((keterlambatan % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var terlambatMinutes = Math.floor((keterlambatan % (1000 * 60 * 60)) / (1000 * 60));
                    var terlambatSeconds = Math.floor((keterlambatan % (1000 * 60)) / 1000);
                    keterlambatanElement.innerHTML = "Terlambat: " + terlambatDays + "d " + terlambatHours + "h " + terlambatMinutes + "m " + terlambatSeconds + "s ";
                    timerElement.parentElement.style.backgroundColor = "red";
                }
            } else if (status{{ $dispensasi->id }} == 4) {
                // Dispensation is completed
                clearInterval(timer{{ $dispensasi->id }});
                var waktuSelesaiFormatted = new Date(waktuSelesai{{ $dispensasi->id }}).toLocaleString();
                timerElement.innerHTML = "Selesai: " + waktuSelesaiFormatted;

                // Check if waktu_selesai exceeds waktu_kembali
                if (waktuSelesai{{ $dispensasi->id }} > waktuKembali{{ $dispensasi->id }}) {
                    timerElement.parentElement.style.backgroundColor = "red";
                }
                
                keterlambatanElement.innerHTML = ""; // Clear keterlambatan display
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
