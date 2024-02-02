@extends('layouts.main')

@section('container')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-5">
            <form action="change-password" method="post" class="w-50">
                @csrf
                <div class="mb-3">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" id="oldPassword" name="old_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="new_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="repeatPassword">Repeat Password</label>
                    <input type="password" id="repeatPassword" name="repeat_password" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection