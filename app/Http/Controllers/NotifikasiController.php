<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function destroy($id)
    {
        $user = User::find(Auth::id()); // Fetch the authenticated user
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();

        toast()->success('Berhasil', 'Pesan berhasil dihapus');
        return redirect()->back()->withInput();
    }
}
