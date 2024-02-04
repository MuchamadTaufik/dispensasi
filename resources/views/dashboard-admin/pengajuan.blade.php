@extends('layouts.main')

@section('container')
    
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <form action="/pengajuan" method="POST" class="mt-3">
                @csrf
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <select class="form-control" name="user_id" style="display: none;">
                        @foreach ($users as $user)
                            @if (auth()->user()->id === $user->id)
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>              
                <div class="mb-2">
                    <label for="jam_keluar" class="form-label">Jam Keluar</label>
                    <input type="datetime-local" class="form-control @error('jam_keluar') is-invalid @enderror" id="jam_keluar" name="jam_keluar" required autofocus value="{{ old('jam_keluar') }}">
                    @error('jam_keluar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="jam_kembali" class="form-label">Jam Kembali</label>
                    <input type="datetime-local" class="form-control @error('jam_kembali') is-invalid @enderror" id="jam_kembali" name="jam_kembali" required autofocus value="{{ old('jam_kembali') }}">
                    @error('jam_kembali')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="alasan" class="form-label">Alasan</label>
                    <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" required autofocus value="{{ old('alasan') }}">
                    @error('alasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="bukti" class="form-label">Bukti</label>
                    <input type="text" class="form-control @error('bukti') is-invalid @enderror" id="bukti" name="bukti" required autofocus value="{{ old('bukti') }}">
                    @error('bukti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
</div>
@endsection