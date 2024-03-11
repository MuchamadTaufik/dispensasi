@extends('layouts.main')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Notifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>Notifikasi</th>
                        <th>Name</th>
                        <th>Alasan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $notifications = collect(); // Membuat koleksi kosong
                        foreach (\App\Models\User::all() as $user) {
                            $notifications = $notifications->merge($user->notifications->where('type', 'App\Notifications\DispensasiApprove'));
                        }
                        $notifications = $notifications->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp

                    @foreach($notifications as $notification)
                        <tr class="table-warning">
                            <td>{{ $notification->data['title'] }}</td>
                            <td>{{ $notification->data['name'] }}</td>
                            <td>{{ $notification->data['alasan'] }}</td>
                            <td>{{ $notification->data['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
