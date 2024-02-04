@extends('layouts.main')

@section('container')
    
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dispensasi
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Jam Keluar</th>
                                <th>Jam Kembali</th>
                                <th>Alasan</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Jam Keluar</th>
                                <th>Jam Kembali</th>
                                <th>Alasan</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dispensasis as $dispensasi)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $dispensasi->user->name }}</td>
                                <td>{{ $dispensasi->jam_keluar }}</td>
                                <td>{{ $dispensasi->jam_kembali }}</td>
                                <td>{{ $dispensasi->alasan }}</td>
                                <td>{{ $dispensasi->bukti }}</td>
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