@extends('layouts.main')

@section('container')
    <form action="/pengajuan" method="POST" class="mt-3" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="type_id" class="form-label">Tipe Dispensasi</label>
            <select class="form-control" name="type_id" id="type_id" required>
                <option value="" @if(old('type_id') === null) selected @endif>-- Pilih Tipe Dispensasi --</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if(old('type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                @endforeach
            </select>
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
        <div class="mb-2" id="waktuMasukContainer">
            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
            <input type="datetime-local" class="form-control @error('waktu_masuk') is-invalid @enderror" id="waktu_masuk" name="waktu_masuk" autofocus value="{{ old('waktu_masuk') }}">
            @error('waktu_masuk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2" id="waktuKeluarContainer">
            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
            <input type="datetime-local" class="form-control @error('waktu_keluar') is-invalid @enderror" id="waktu_keluar" name="waktu_keluar" autofocus value="{{ old('waktu_keluar') }}">
            @error('waktu_keluar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2" id="waktuKembaliContainer">
            <label for="waktu_kembali" class="form-label">Waktu Kembali</label>
            <input type="datetime-local" class="form-control @error('waktu_kembali') is-invalid @enderror" id="waktu_kembali" name="waktu_kembali" autofocus value="{{ old('waktu_kembali') }}">
            @error('waktu_kembali')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="alasan_id" class="form-label">Alasan Dispensasi</label>
            <select class="form-control" name="alasan_id" id="alasan_id" required>
                <option value="" @if(old('type_id') === null) selected @endif>-- Pilih Alasan Dispensasi --</option>
                @foreach ($alasans as $alasan)
                    <option value="{{ $alasan->id }}" @if(old('alasan_id') == $alasan->id) selected @endif>{{ $alasan->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            @error('deskripsi')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti</label>
            <input type="file" class="form-control @error('bukti') is-invalid @enderror" id="bukti" name="bukti" required autofocus>
            @error('bukti')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        // Add an event listener for Trix Editor change event
        document.addEventListener('trix-change', function(event) {
            // Get the raw text content from Trix Editor
            var rawText = stripHtml(event.target.innerHTML);

            // Set the raw text value to the hidden input
            document.getElementById('deskripsi').value = rawText;
        });

        // Function to strip HTML tags
        function stripHtml(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }

        document.addEventListener('trix-initialize', function () {
                // Remove the "Attach Files" button
                const fileToolsButton = document.querySelector('.trix-button[data-trix-action="attachFiles"]');
                if (fileToolsButton) {
                    fileToolsButton.remove();
                }
            });

        document.addEventListener('DOMContentLoaded', function () {
        // Hide initial state of containers
        document.getElementById('waktuMasukContainer').style.display = 'none';
        document.getElementById('waktuKeluarContainer').style.display = 'none';
        document.getElementById('waktuKembaliContainer').style.display = 'none';

        // Add change event listener to type_id dropdown
        document.getElementById('type_id').addEventListener('change', function () {
            // Get the selected value
            var selectedType = this.value;

            // Reset all containers to hide and remove required attribute
            document.getElementById('waktuMasukContainer').style.display = 'none';
            document.getElementById('waktuKeluarContainer').style.display = 'none';
            document.getElementById('waktuKembaliContainer').style.display = 'none';

            document.getElementById('waktu_keluar').required = false;
            document.getElementById('waktu_kembali').required = false;

            // Show the relevant container based on the selected type
            if (selectedType == 1) {
                document.getElementById('waktuMasukContainer').style.display = 'block';
            } else if (selectedType == 2) {
                document.getElementById('waktuKeluarContainer').style.display = 'block';
                document.getElementById('waktuKembaliContainer').style.display = 'block';

                // Set required attribute for waktu_keluar and waktu_kembali
                document.getElementById('waktu_keluar').required = true;
                document.getElementById('waktu_kembali').required = true;
            }
        });
    });
    </script>
@endsection
