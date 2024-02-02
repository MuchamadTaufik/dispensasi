<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function ShowUserlist(){
        $user = User::all();
        return view('dashboard-admin.users', compact('user'));
    }

    public function index()
    {
        return view ('auth.login',[
            'title' => 'Login'
        ]);
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

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

    // public function changePassword()
    // {
    //     return view('auth.change-password');
    // }

    // public function processChangePassword(Request &$request)
    // {
    //     if(!Hash::check($request->old_password, auth()->user()->passwrod)) {
    //         return back()->with('error', 'old password not match with your current password');
    //     }

    //     if($request->new_password != $request->repeat_password) {
    //         return back()->with('error', 'new password and repeat password not match');
    //     }
        
    //     auth()->user()->update([
    //         'password' => Hash::make($request->new_password)
    //     ]);

    //     // $user = auth()->user();
    //     // $user->password = Hash::make($request->new_password);
    //     // /** @var \App\Models\User $user **/
    //     // $user->save();
    // }

    
}
