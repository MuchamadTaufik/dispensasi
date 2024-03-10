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
        return view('dashboard.users.register.manual',[
            'kelas' =>Kelas::all(),
            'roles' =>Role::all()
        ]);
    }
    public function create()
    {
        return view('dashboard.users.register.manual',[
            'kelas' =>Kelas::all(),
            'roles' =>Role::all()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'kelas_id' => 'required',
            'role_id' => 'nullable',
            'nomor_induk' => 'required|max:50',
            'email' => 'required|email|max:255',
        ]);
    
        try {
            $user = User::create($attributes);
            auth()->login($user);
            
            toast()->success('Berhasil', 'Akun berhasil dibuat');
            return redirect('/')->withInput();
        } catch (\Exception $e) {
            toast()->error('Register Gagal', 'Email/Nomor Induk Telah digunakan.');
            return back()->withInput();
        }
    }
}
