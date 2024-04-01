@extends('layouts.main')

@section('container')
    <form action="{{ route('dispensasi.update', $dispensasi->id) }}" method="POST" class="mt-3" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-2">
            <label for="type_id" class="form-label">Type</label>
            <select class="form-control" name="type_id" id="type_id" disabled>
                <option value="" @if(old('type_id') === null) selected @endif>-- Pilih Tipe Dispensasi --</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if(old('type_id', $dispensasi->type_id) == $type->id) selected @endif>{{ $type->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="type_id" value="{{ $dispensasi->type_id }}">
        </div>              
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
        @if ($dispensasi->type_id === 1)
        <div class="mb-2">
            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
            <input type="datetime-local" class="form-control @error('waktu_masuk') is-invalid @enderror" id="waktu_masuk" name="waktu_masuk" autofocus value="{{ old('waktu_masuk', $dispensasi->waktu_masuk) }}">
            @error('waktu_masuk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @endif
        @if ($dispensasi->type_id === 2)
            <div class="mb-2">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="datetime-local" class="form-control @error('waktu_keluar') is-invalid @enderror" id="waktu_keluar" name="waktu_keluar" autofocus value="{{ old('waktu_keluar', $dispensasi->waktu_keluar) }}">
                @error('waktu_keluar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="waktu_kembali" class="form-label">Batas Waktu Kembali</label>
                <input type="datetime-local" class="form-control @error('waktu_kembali') is-invalid @enderror" id="waktu_kembali" name="waktu_kembali" autofocus value="{{ old('waktu_kembali', $dispensasi->waktu_kembali) }}">
                @error('waktu_kembali')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        @if ($dispensasi->type_id === 1 || $dispensasi->type_id === 2)
            <div class="mb-2">
                <label for="waktu_persetujuan" class="form-label">Waktu Persetujuan</label>
                <input type="datetime-local" class="form-control @error('waktu_persetujuan') is-invalid @enderror" id="waktu_persetujuan" name="waktu_persetujuan" autofocus value="{{ old('waktu_persetujuan', $dispensasi->waktu_persetujuan) }}">
                @error('waktu_persetujuan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        @if ($dispensasi->type_id === 2)
            <div class="mb-2">
                <label for="waktu_selesal" class="form-label">Waktu Selesai</label>
                <input type="datetime-local" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" autofocus value="{{ old('waktu_selesai', $dispensasi->waktu_selesai) }}">
                @error('waktu_selesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        <div class="mb-2">
            <label for="alasan_id" class="form-label">Alasan</label>
            <select class="form-control" name="alasan_id" id="alasan_id" required>
                <option value="" @if(old('type_id') === null) selected @endif>-- Pilih Alasan Dispensasi --</option>
                @foreach ($alasans as $alasan)
                    <option value="{{ $alasan->id }}" @if(old('alasan_id', $dispensasi->alasan_id) == $alasan->id) selected @endif>{{ $alasan->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti</label>
            <input type="file" class="form-control @error('bukti') is-invalid @enderror" id="bukti" name="bukti" autofocus onchange="previewImage()">
            @if ($dispensasi->bukti)
                <div class="mt-2">
                    <p>Bukti Sebelumnya:</p>
                    <img src="{{ asset('storage/' . $dispensasi->bukti) }}" class="img-preview img-fluid d-block">
                </div>
            @endif
            @error('bukti')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function previewImage(){
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
