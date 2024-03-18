@extends('layouts.main')

@section('container')

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Dispensasi: {{ $dispensasi->type->name }}</h5>
    </div>
    <div class="card-body">
        <p class="card-text"><strong>Nomor Induk :</strong> <span class="data">{{ $dispensasi->user->nomor_induk }}</span></p>
            <hr class="divider">
        <p class="card-text"><strong>Nama :</strong> <span class="data">{{ $dispensasi->user->name }}</span></p>
            <hr class="divider">
        <p class="card-text"><strong>Kelas :</strong> <span class="data">{{ $dispensasi->user->kelas->name }}</span></p>
            <hr class="divider">
        <p class="card-text"><strong>Alasan :</strong> <span class="data">{{ $dispensasi->alasan->name }}</span></p>
            <hr class="divider">
        <p class="card-text"><strong>Bukti :</strong> <a href="{{ asset('storage/' . $dispensasi->bukti) }}" target="_blank"><span data-feather="eye"></span></a></p>
            <hr class="divider">
        @if ($dispensasi->type_id === 2)
            <p class="card-text"><strong>Waktu Keluar :</strong> <span class="data">{{ $dispensasi->waktu_keluar }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Batas Waktu Kembali :</strong> <span class="data">{{ $dispensasi->waktu_kembali }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Waktu Persetujuan :</strong> <span class="data">{{ $dispensasi->waktu_persetujuan }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Waktu Selesai :</strong> <span class="data">{{ $dispensasi->waktu_selesai }}</span></p>
                <hr class="divider">
        @endif
        @if ($dispensasi->type_id === 1)
            <p class="card-text"><strong>Waktu Masuk :</strong> <span class="data">{{ $dispensasi->waktu_masuk }}</span></p>
                <hr class="divider">
            <p class="card-text"><strong>Waktu Persetujuan :</strong> <span class="data">{{ $dispensasi->waktu_persetujuan }}</span></p>
                <hr class="divider">
        @endif
        <p class="card-text"><strong>Deskripsi :</strong> <span class="data">{{ $dispensasi->deskripsi }}</span></p>
            <hr class="divider">
        <a href="/" class="btn btn-primary"><span data-feather="arrow-left"></span> Kembali</a>
    </div>
</div>


@endsection