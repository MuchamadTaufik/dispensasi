<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dispensasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate the total dispensasi
        $dispensasisMasuk = Dispensasi::where('type_id', 1)->count();
        $dispensasisKeluar = Dispensasi::where('type_id', 2)->count();

        $dispensasisSakit = Dispensasi::where('alasan_id', 1)->count();
        $dispensasisIzin = Dispensasi::where('alasan_id', 2)->count();

        return view('dashboard-admin.index', [
            'users' => User::count(),
            'totalDispensasi' => Dispensasi::count(),
            'dispensasisMasuk' => $dispensasisMasuk,
            'dispensasisKeluar' => $dispensasisKeluar,
            'dispensasisSakit' => $dispensasisSakit,
            'dispensasisIzin' => $dispensasisIzin,
        ]);
    }
}
