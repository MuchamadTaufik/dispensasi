@extends('auth.layouts.main')

@section('container')
    <div class="text-center">
        <img src="img/logo_man2.png" alt="" width="80" height="100">
        <h1 class="h2 text-gray-900 mb-2">Daftar Akun</h1>
        <h1 class="h6 text-gray-900 mb-4">MAN 2 KOTA BANDUNG</h1>
    </div>
    <form class="user" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input class="form-control form-control-user" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukan Nama...">
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="nomor_induk" type="number" name="nomor_induk" value="{{ old('nomor_induk') }}" required placeholder="Masukan Nomor Induk...">
        </div>
        <div class="form-group">
            <select class="form-select form-control-user" name="kelas_id" required style="width: 100%">
                <option value="" @if(old('kelas_id') === null) selected @endif>-- Pilih Kelas --</option>
                @foreach ($kelas as $kelases)
                    <option value="{{ $kelases->id }}" @if(old('kelas_id') == $kelases->id) selected @endif>{{ $kelases->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-select form-control-user" name="role_id" required style="width: 100%">
                <option value="" @if(old('role_id') === null) selected @endif>-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Masukan Alamat Email...">
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="password" type="password" name="password" placeholder="Masukan Password...">
        </div>
        <div class="mb-0">
            <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
        </div>
    </form>
    <h1 class="h6 text-gray-900 mt-2 text-center">
        Sudah memiliki akun ?
            <a href="{{ route('login') }}"
                class="text-primary text-gradient font-weight-bold">Masuk</a>
    </h1>
@endsection