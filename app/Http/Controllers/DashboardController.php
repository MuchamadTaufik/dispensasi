<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dispensasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dispensasisMasuk = Dispensasi::where('type_id', 1)->where('status_id', 2)->count();
        $dispensasisKeluar = Dispensasi::where('type_id', 2)->where('status_id', 2)->count();

        $dispensasisSakit = Dispensasi::where('alasan_id', 1)->where('status_id', 2)->count();
        $dispensasisIzin = Dispensasi::where('alasan_id', 2)->where('status_id', 2)->count();

        $dispensasisAktif = Dispensasi::where('type_id', 2)->where('status_id', 2)->count();
        $dispensasisGuru = User::join('dispensasis', 'users.id', '=', 'dispensasis.user_id')
            ->where('users.kelas_id', 1)
            ->where(function ($query) {
                $query->where(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 4)
                            ->where('dispensasis.type_id', 2);
                })->orWhere(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 2)
                            ->where('dispensasis.type_id', 1);
                });
            })
            ->count();
        
        $dispensasisSiswa = User::join('dispensasis', 'users.id', '=', 'dispensasis.user_id')
            ->where('users.kelas_id', '<>', 1)
            ->where(function ($query) {
                $query->where(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 4)
                            ->where('dispensasis.type_id', 2);
                })->orWhere(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 2)
                            ->where('dispensasis.type_id', 1);
                });
            })
            ->count();

        return view('dashboard.index', [
            'users' => User::count(),
            'totalDispensasi' => Dispensasi::where(function ($query) {
                $query->where(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 4)
                            ->where('dispensasis.type_id', 2);
                })->orWhere(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 2)
                            ->where('dispensasis.type_id', 1);
                });
            })
            ->count(),
            'dispensasisMasuk' => $dispensasisMasuk,
            'dispensasisKeluar' => $dispensasisKeluar,
            'dispensasisSakit' => $dispensasisSakit,
            'dispensasisIzin' => $dispensasisIzin,
            'dispensasisAktif' => $dispensasisAktif,
            'dispensasisGuru' => $dispensasisGuru,
            'dispensasisSiswa' => $dispensasisSiswa
        ]);
    }
}
