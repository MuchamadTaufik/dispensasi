@extends('layouts.main')

@section('container')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary sidebar sidebar-dark accordion text-white" id="accordionSidebar">
                        <th>No</th>
                        <th>Name</th>
                        <th>Nomor Induk</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody
                    @php
                        $user = $user->sortByDesc('created_at'); // Mengurutkan notifikasi berdasarkan waktu terbaru
                    @endphp>
                    @foreach ($user as $users)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->nomor_induk }}</td>
                                <td>{{ $users->kelas->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->role->name }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $users->id) }}" class="badge bg-warning border-0"><span data-feather="edit"></span></a>
                                    <form action="{{ route('users.delete', $users->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="trash-2"></span></button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection