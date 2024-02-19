@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mt-4">
                <!-- Tampilkan notifikasi -->
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Tampilkan notifikasi approve dari semua pengguna -->
                @foreach(\App\Models\User::all() as $user)
                    @foreach($user->notifications->where('type', 'App\Notifications\DispensasiApprove') as $notification)
                        <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <strong>{{ $notification->data['title'] }}</strong><br>
                                    {{ $notification->data['messages'] }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endforeach
                @endforeach

                <!-- Tampilkan notifikasi reject hanya untuk pengguna terkait -->
                @foreach(auth()->user()->notifications->where('type', 'App\Notifications\DispensasiReject') as $notification)
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <strong>{{ $notification->data['title'] }}</strong><br>
                                {{ $notification->data['messages'] }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endforeach

                <!-- Konten tampilan lainnya -->
            </div>
        </main>
    </div>
@endsection
