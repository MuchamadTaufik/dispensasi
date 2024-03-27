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

    public function edit(User $user)
    { 
        return view('dashboard.users.edit',[
            'user' => $user,
            'kelas' => Kelas::all(),
            'roles' => Role::all()
        ]);
    }
    
    public function update(Request $request, User $user){
        try {
            $rules = [
                'name' => 'required|max:255',
                'kelas_id' => 'required',
                'role_id' => 'nullable',
                'nomor_induk' => 'required|max:50',
                'email' => 'required|email|max:255',
            ];
        
            $validateData = $request->validate($rules);
        
            $user->update($validateData);
        
            alert()->success('Success', 'Data User Berhasil di Ubah');
            return redirect('/users')->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        User::destroy ($user->id);

        alert()->success('Success', 'Data User Berhasil di Hapus');
        return redirect('/users')->withInput();
    }
}
