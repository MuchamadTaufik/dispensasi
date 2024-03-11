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
                    @foreach(\App\Models\User::all() as $user)
                        @foreach($user->notifications->where('type', 'App\Notifications\DispensasiApprove') as $notification)
                            <tr class="table-warning">
                                <td>{{ $notification->data['title'] }}</td>
                                <td>{{ $notification->data['name'] }}</td>
                                <td>{{ $notification->data['alasan'] }}</td>
                                <td>{{ $notification->data['date'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
