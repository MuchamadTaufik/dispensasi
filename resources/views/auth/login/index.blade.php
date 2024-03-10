@extends('auth.layouts.main')

@section('container')
    <div class="text-center">
        <img src="img/logo_man2.png" alt="" width="80" height="100">
        <h1 class="h2 text-gray-900 mb-2">Masuk dan Verifikasi</h1>
        <h1 class="h6 text-gray-900 mb-4">MAN 2 KOTA BANDUNG</h1>
    </div>
    <form class="user" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input class="form-control form-control-user" id="nomor_induk" type="number" name="nomor_induk" value="{{ old('nomor_induk') }}" required autofocus placeholder="Masukan Nomor Induk...">
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="password" type="password" name="password" required placeholder="Masukan Password...">
        </div>
        <div class="mb-0">
            <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
        </div>
    </form>
@endsection