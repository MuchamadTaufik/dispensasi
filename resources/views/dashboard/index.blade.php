@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Dispensasi Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dispensasisAktif }} Dispensasi</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Dispensasi Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dispensasisGuru }} User</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Dispensasi Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dispensasisSiswa }} User</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Dispensasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDispensasi }} Dispensasi</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Dispensasi Berdasarkan Type</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Pilih Tahun :</div>
                            @foreach($years as $year)
                                <a class="dropdown-item" href="{{ route('dashboard.index', ['selectedYear' => $year]) }}">{{ $year }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pt-4 pb-2">
                    {!! $dispensasiTypeChart->container() !!}
                </div>
            </div>
        </div>
    
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Dispensasi Berdasarkan Alasan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Pilih Tahun :</div>
                            @foreach($years as $year)
                                <a class="dropdown-item" href="{{ route('dashboard.index', ['selectedYear' => $year]) }}">{{ $year }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pt-4 pb-2">
                    {!! $dispensasiAlasanChart->container() !!}
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <!-- Bar Chart -->
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Dispensasi per Bulan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Select Year:</div>
                            <!-- Form untuk memilih tahun -->
                            <form method="GET" action="{{ route('dashboard.index') }}" class="px-4 py-3">
                                @csrf
                                <!-- Dropdown untuk memilih tahun -->
                                <div class="form-group">
                                    <select class="form-control" id="selectedYear" name="selectedYear">
                                        @for ($year = date('Y'); $year >= 2010; $year--)
                                            <option value="{{ $year }}" {{ $year == request('selectedYear', date('Y')) ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <!-- Tombol untuk submit form -->
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Menampilkan chart menggunakan container yang disediakan -->
                    {!! $dispensasiChart->container() !!}
                </div>
            </div>
        </div>
    </div>

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
                            <th>Nomor Induk</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Type Dispensasi</th>
                            <th>Alasan Dispensasi</th>
                            <th>Waktu Keluar</th>
                            <th>Batas Waktu Kembali</th>
                            <th>Waktu Selesai</th>
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
                            <td>{{ $dispensasi->user->nomor_induk }}</td>
                            <td>{{ $dispensasi->user->name }}</td>
                            <td>{{ $dispensasi->user->kelas->name }}</td>
                            <td>{{ $dispensasi->type->name }}</td>
                            <td>{{ $dispensasi->alasan->name }}</td>
                            <td>{{ $dispensasi->waktu_keluar }}</td>
                            <td>{{ $dispensasi->waktu_kembali }}</td>
                            <td class="waktu-selesai">{{ $dispensasi->waktu_selesai }}</td>
                            <td>Show | Delete</td>
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
                            <th>Nomor Induk</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Type Dispensasi</th>
                            <th>Alasan Dispensasi</th>
                            <th>Waktu Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dispensasisMasuk = $dispensasisMasuk->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                        @endphp
                        @foreach ($dispensasisMasuk as $dispensasi)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $dispensasi->user->nomor_induk }}</td>
                                <td>{{ $dispensasi->user->name }}</td>
                                <td>{{ $dispensasi->user->kelas->name }}</td>
                                <td>{{ $dispensasi->type->name }}</td>
                                <td>{{ $dispensasi->alasan->name }}</td>
                                <td>{{ $dispensasi->waktu_masuk }}</td>
                                <td>Show | Delete</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ $dispensasiTypeChart->cdn() }}"></script>
    <script src="{{ $dispensasiAlasanChart->cdn() }}"></script>
    <script src="{{ $dispensasiChart->cdn() }}"></script>

    {{ $dispensasiTypeChart->script() }}
    {{ $dispensasiAlasanChart->script() }}
    {{ $dispensasiChart->script() }}

    <script>
        // Iterate over each cell in the "Waktu Selesai" column
        document.querySelectorAll("#dataTable tbody tr .waktu-selesai").forEach(cell => {
            // Get the time strings
            let waktuKembaliStr = cell.previousElementSibling.innerText; // Get the "Batas Waktu Kembali" value from the previous cell
            let waktuSelesaiStr = cell.innerText;

            // Parse the time strings into Date objects
            let waktuKembali = new Date(waktuKembaliStr);
            let waktuSelesai = new Date(waktuSelesaiStr);

            // Check if waktuSelesai is greater than waktuKembali
            if (waktuSelesai > waktuKembali) {
                // If it is, change the background color of the cell to red
                cell.classList.add('bg-danger', 'text-white');
            } else {
                // Otherwise, change the background color of the cell to green
                cell.classList.add('bg-success', 'text-white');
            }
        });
    </script>

@endsection