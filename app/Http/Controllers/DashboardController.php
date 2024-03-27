<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Models\Dispensasi;
use Illuminate\Http\Request;
use App\Charts\DispensasiChart;
use App\Charts\DispensasiTypeChart;
use Illuminate\Support\Facades\Auth;
use App\Charts\DispensasiAlasanChart;

class DashboardController extends Controller
{
    public function index(Request $request, DispensasiTypeChart $dispensasiTypeChart, DispensasiAlasanChart $dispensasiAlasanChart, DispensasiChart $dispensasiChart)
    {
            // Mendapatkan tahun yang dipilih dari permintaan pengguna
        $selectedYear = $request->input('selectedYear', date('Y'));

        // Mendapatkan daftar tahun untuk opsi dropdown
        $years = Dispensasi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        //dashboard index untuk tabel
        // Mendapatkan pengguna yang sedang terotentikasi
        $user = Auth::user();

        $dispensasisAktif = Dispensasi::where('type_id', 2)->where('status_id', 2)->whereYear('created_at', $selectedYear)->count();
        $dispensasisGuru = User::join('dispensasis', 'users.id', '=', 'dispensasis.user_id')
            ->where('users.kelas_id', 1)
            ->whereYear('dispensasis.created_at', $selectedYear)
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
            ->whereYear('dispensasis.created_at', $selectedYear)
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

        // Inisialisasi variabel dispensasisKeluar dan dispensasisMasuk
        $dispensasisKeluar = null;
        $dispensasisMasuk = null;

        // // Inisialisasi variabel dispensasisSakit dan dispensasisIzin
        // $dispensasisSakit = null;
        // $dispensasisIzin = null;

        // Jika pengguna adalah admin, dapatkan semua data dispensasi
        if ($user->role_id === 1 || $user->role_id === 2) {
            $dispensasisKeluar = Dispensasi::where('type_id', 2)
            ->whereYear('created_at', $selectedYear)
            ->get();
            $dispensasisMasuk = Dispensasi::where('type_id', 1)
            ->whereYear('created_at', $selectedYear)
            ->get();
        } else {
            // Jika pengguna bukan admin, hanya dapatkan data dispensasi yang terkait dengan pengguna
            $dispensasisKeluar = Dispensasi::where('user_id', $user->id)
            ->where('type_id', 2)
            ->whereYear('created_at', $selectedYear)
            ->get();
            $dispensasisMasuk = Dispensasi::where('user_id', $user->id)
            ->where('type_id', 1)
            ->whereYear('created_at', $selectedYear)
            ->get();
        }

        return view('dashboard.index', [
            'totalDispensasi' => Dispensasi::where(function ($query) {
                $query->where(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 4)
                            ->where('dispensasis.type_id', 2);
                })->orWhere(function ($innerQuery) {
                    $innerQuery->where('dispensasis.status_id', 2)
                            ->where('dispensasis.type_id', 1);
                });
            })->whereYear('dispensasis.created_at', $selectedYear)
            ->count(),
            'selectedYear' => $selectedYear,
            'dispensasisAktif' => $dispensasisAktif,
            'dispensasisGuru' => $dispensasisGuru,
            'dispensasisSiswa' => $dispensasisSiswa,

            'years' => $years, // Mengirim daftar tahun ke tampilan
            'dispensasiTypeChart' => $dispensasiTypeChart->build($selectedYear),
            'dispensasiAlasanChart' => $dispensasiAlasanChart->build($selectedYear),
            'dispensasiChart' => $dispensasiChart->build($selectedYear),
            'dispensasisKeluar' => $dispensasisKeluar,
            'dispensasisMasuk' => $dispensasisMasuk
        ]);
    }

    public function laporanDispensasiKeluar(Request $request)
    {
        $user = Auth::user();
        $selectedYear = $request->input('selectedYear', date('Y'));

        // Mendapatkan data dispensasi keluar
        if( $user->role_id === 2 || $user->role_id === 1) {
            $dispensasisKeluar = Dispensasi::whereYear('created_at', $selectedYear)->where('status_id', 4)->orderByDesc('created_at')->get();
        } else {
            $dispensasisKeluar = Dispensasi::whereYear('created_at', $selectedYear)->where('user_id', $user->id )->where('status_id', 4)->orderByDesc('created_at')->get();
        }

        // Menghasilkan laporan PDF untuk dispensasi keluar
        $pdfDispensasiKeluar = $this->generatePDF($dispensasisKeluar, 'dispensasi_keluar', $selectedYear);

        return $pdfDispensasiKeluar; // Mengembalikan hasil download PDF
    }

    public function laporanDispensasiMasuk(Request $request)
    {
        $user = Auth::user();
        $selectedYear = $request->input('selectedYear', date('Y'));

        // Mendapatkan data dispensasi masuk
        if( $user->role_id === 2 || $user->role_id === 1 ) {
            $dispensasisMasuk = Dispensasi::whereYear('created_at', $selectedYear)->where('status_id', 2)->orderByDesc('created_at')->get();
        } else {
            $dispensasisMasuk = Dispensasi::whereYear('created_at', $selectedYear)->where('user_id', $user->id )->where('status_id', 2)->orderByDesc('created_at')->get();
        }

        // Menghasilkan laporan PDF untuk dispensasi masuk
        $pdfDispensasiMasuk = $this->generatePDF($dispensasisMasuk, 'dispensasi_masuk', $selectedYear);

        return $pdfDispensasiMasuk; // Mengembalikan hasil download PDF
    }

    public function generatePDF($dispensasis, $viewName, $selectedYear)
    {
        $pdf = app(PDF::class);
        $pdf->loadView('dashboard.laporan.' . $viewName, [
            'dispensasis' => $dispensasis,
            'selectedYear' => $selectedYear 
        ]);

        return $pdf->download('laporan_' . $viewName . '_' . $selectedYear . '.pdf');
    }
}
