@extends('layouts.main')

@section('container')
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" accept=".xlsx, .csv" class="form-label">Upload File Excel</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required autofocus>
            @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
        <div class="mb-3 mt-3">
            <a href="{{ asset('/tamplate/tamplate_excel.xlsx') }}" class="btn btn-secondary">Download Template</a>
            <a href="{{ asset('/tamplate/daftar_kelas.xlsx') }}" class="btn btn-secondary">daftar kelas</a>
        </div>
    </form>
@endsection