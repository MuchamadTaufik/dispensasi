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
                                            <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download="{{ $dispensasi->bukti }}">
                                                {{ $dispensasi->bukti }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>ACC</td>
                                    <td>Hapus</td>
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
                                            <a href="{{ asset('storage/' . $dispensasi->bukti) }}" download="{{ $dispensasi->bukti }}">
                                                {{ $dispensasi->bukti }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>ACC</td>
                                    <td>Hapus</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
