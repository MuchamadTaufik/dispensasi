@extends('layouts.main')

@section('container')
    <form class="user" method="POST" action="{{ route('users.update', $user->id) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <input class="form-control form-control-user" id="name" type="text" name="name" value="{{ old('name',$user->name) }}" required>
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="nomor_induk" type="number" name="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}" required>
        </div>
        <div class="form-group">
            <select class="form-select form-control-user" name="kelas_id" required style="width: 100%">
                <option value="" @if(old('kelas_id') === null) selected @endif>-- Pilih Kelas --</option>
                @foreach ($kelas as $kelases)
                    <option value="{{ $kelases->id }}" @if(old('kelas_id', $user->kelas_id) == $kelases->id) selected @endif>{{ $kelases->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-select form-control-user" name="role_id" required style="width: 100%">
                <option value="" @if(old('role_id') === null) selected @endif>-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control form-control-user" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Masukan Alamat Email...">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </form>
@endsection