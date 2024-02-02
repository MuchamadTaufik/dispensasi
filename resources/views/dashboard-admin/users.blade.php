@extends('layouts.main')

@section('container')
    
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Users Account
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Nomor Induk</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Nomor Induk</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user as $users)
                            <tr>
                                <td>{{ $users->id }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->nomor_induk }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->role->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection