<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register',[
            'kelas' =>Kelas::all(),
            'roles' =>Role::all()
        ]);
    }
    public function create()
    {
        return view('auth.register',[
            'kelas' =>Kelas::all(),
            'roles' =>Role::all()
        ]);
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'kelas_id' => 'required',
            'role_id' => 'nullable',
            'nomor_induk' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        
        return redirect('/');
    }
}
