@extends('layouts.main')

@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-5">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx, .csv">
                <button type="submit">Import</button>
            </form>
            
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif
        </div>
    </main>
</div>
@endsection