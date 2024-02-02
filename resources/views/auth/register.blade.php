@extends('auth.layouts.main')

@section('container')
        <main>
            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Register</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" class="block w-full mt-1" type="text" name="name" value="{{ old('name') }}" required autofocus />
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="nomor_induk" class="block w-full mt-1" type="number" name="nomor_induk" value="{{ old('nomor_induk') }}"  required />
                                        <label for="nomor_induk">Nomor Induk</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" class="block w-full mt-1" type="email" name="email" value="{{ old('email') }}"  required />
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" class="block w-full mt-1" type="password" name="password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit">Sign-up</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Already have an account?
                                    <a href="{{ route('login') }}"
                                        class="text-primary text-gradient font-weight-bold">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection