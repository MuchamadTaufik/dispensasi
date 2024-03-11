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
                                <form action="{{ route('admin-product.destroy', $product->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                                </form> 
                            </td>
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
