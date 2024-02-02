<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'nomor_induk' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        
        return redirect('/');
    }
}
