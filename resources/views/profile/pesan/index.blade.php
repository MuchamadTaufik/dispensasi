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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $notifications = auth()->user()->notifications->whereIn('type', ['App\Notifications\DispensasiApprove', 'App\Notifications\DispensasiReject']);
                        $notifications = $notifications->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp

                    @forelse($notifications as $notification)
                        <tr class="{{ $notification->type == 'App\Notifications\DispensasiApprove' ? 'table-success' : 'table-danger' }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $notification->data['title'] }} {{ $notification->data['messages'] }}</td>
                            <td>{{ $notification->data['alasan'] }}</td>
                            <td>{{ $notification->data['date'] }}</td>
                            <td>{!! $notification->data['surat'] !!}</td>
                            <td>
                                <form action="{{ route('notifikasi.destroy', ['id' => $notification->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada pesan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
