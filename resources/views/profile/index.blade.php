@extends('layouts.main')

@section('container')
<div class="card card-body mx-3 mx-md-4 mt-n6">
    <div class="row gx-4 mb-2">
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                    {{ auth()->user()->role->name }}
                </h5>
            </div>
        </div>
    </div>
    <div class="card card-plain h-100">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-3">Profile Information</h6>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <p class="border border-2 p-2">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Kelas</label>
                        <p class="border border-2 p-2">{{ auth()->user()->kelas->name }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nomor Induk</label>
                        <p class="border border-2 p-2">{{ auth()->user()->nomor_induk }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <p class="border border-2 p-2">{{ auth()->user()->email }}</p>
                        <p><a href="/change-password">Ubah Password</a></p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection