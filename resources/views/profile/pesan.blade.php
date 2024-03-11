@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pesan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>No</th>
                        <th>Notifikasi</th>
                        <th>Alasan</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->notifications->whereIn('type', ['App\Notifications\DispensasiApprove', 'App\Notifications\DispensasiReject']) as $notification)
                        <tr class="{{ $notification->type == 'App\Notifications\DispensasiApprove' ? 'table-success' : 'table-danger' }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $notification->data['title'] }} {{ $notification->data['messages'] }}</td>
                            <td>{{ $notification->data['alasan'] }}</td>
                            <td>{{ $notification->data['date'] }}</td>
                            <td>{!! $notification->data['surat'] !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada pesan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
