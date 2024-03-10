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
    </form>
@endsection