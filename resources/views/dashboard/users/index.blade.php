@extends('layouts.main')

@section('container')

<h1 class="h3 mb-2 text-gray-800">Tabel Pengguna</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Nomor Induk</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                            <th>Name</th>
                            <th>Nomor Induk</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($user as $users)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->nomor_induk }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->role->name }}</td>
                                <td>Delete</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection