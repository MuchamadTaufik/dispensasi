<?php

namespace App\Http\Controllers;

use App\Charts\DispensasiAlasanChart;
use App\Charts\DispensasiChart;
use App\Charts\DispensasiTypeChart;
use App\Models\User;
use App\Models\Dispensasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, DispensasiTypeChart $dispensasiTypeChart, DispensasiAlasanChart $dispensasiAlasanChart, DispensasiChart $dispensasiChart)
    {
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

            // Mendapatkan tahun yang dipilih dari permintaan pengguna
        $selectedYear = $request->input('selectedYear', date('Y'));

        // Mendapatkan daftar tahun untuk opsi dropdown
        $years = Dispensasi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        return view('dashboard.index', [
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
            'dispensasisAktif' => $dispensasisAktif,
            'dispensasisGuru' => $dispensasisGuru,
            'dispensasisSiswa' => $dispensasisSiswa,

            'years' => $years, // Mengirim daftar tahun ke tampilan
            'dispensasiTypeChart' => $dispensasiTypeChart->build($selectedYear),
            'dispensasiAlasanChart' => $dispensasiAlasanChart->build($selectedYear),
            'dispensasiChart' => $dispensasiChart->build($selectedYear)
        ]);
    }
}
