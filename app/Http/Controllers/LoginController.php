<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function ShowUserlist(){
        $user = User::all();
        return view('dashboard.users.index', compact('user'));
    }

    public function index()
    {
        return view ('auth.login.index');
    }

    public function authenticate(Request $request)
    {
        $credentianls = $request->validate([
            'nomor_induk' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentianls)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        toast()->error('Login Gagal', 'Harap masukan nomor induk dan password yang benar.');
        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }


    public function processChangePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            toast()->error('Gagal', 'Password lama tidak cocok dengan password saat ini');
            return back()->withInput();
        }

        if ($request->new_password != $request->repeat_password) {
            toast()->error('Gagal', 'Password baru dan ulangi password tidak cocok');
            return back()->withInput();
        }
        
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        /** @var \App\Models\User $user **/
        $user->save();

        toast()->success('Berhasil', 'Password berhasil diubah');
        return redirect()->back();
    }

    
}
