@extends('layouts.main')

@section('container')
    <form class="user" method="POST" action="{{ route('change-password') }}">
        @csrf
        <div class="form-group">
            <input class="form-control form-control-user" id="oldPassword" type="password" name="old_password" autofocus placeholder="Masukan Password Lama...">
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="newPassword" type="password" name="new_password" autofocus placeholder="Masukan Password Baru...">
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="repeatPassword" type="password" name="repeat_password" autofocus placeholder="Masukan Kembali Password Baru...">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
@endsection