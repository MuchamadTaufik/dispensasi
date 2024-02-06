<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Dispensasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDispensasiRequest;
use App\Http\Requests\UpdateDispensasiRequest;
use App\Models\Alasan;

class DispensasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan pengguna yang sedang terotentikasi
        $user = Auth::user();

        // Inisialisasi variabel dispensasisKeluar dan dispensasisMasuk
        $dispensasisKeluar = null;
        $dispensasisMasuk = null;

        // Inisialisasi variabel dispensasisSakit dan dispensasisIzin
        $dispensasisSakit = null;
        $dispensasisIzin = null;

        // Jika pengguna adalah admin, dapatkan semua data dispensasi
        if ($user->role_id === 1 || $user->role_id === 2) {
            $dispensasisKeluar = Dispensasi::where('type_id', 2)->get();
            $dispensasisMasuk = Dispensasi::where('type_id', 1)->get();

            $dispensasisSakit = Dispensasi::where('alasan_id', 'sakit')->get();
            $dispensasisIzin = Dispensasi::where('alasan_id', 'izin')->get();
        } else {
            // Jika pengguna bukan admin, hanya dapatkan data dispensasi yang terkait dengan pengguna
            $dispensasisKeluar = Dispensasi::where('user_id', $user->id)->where('type_id', 2)->get();
            $dispensasisMasuk = Dispensasi::where('user_id', $user->id)->where('type_id', 1)->get();

            $dispensasisSakit = Dispensasi::where('user_id', $user->id)->where('alasan_id', 'sakit')->get();
            $dispensasisIzin = Dispensasi::where('user_id', $user->id)->where('alasan_id', 'izin')->get();
        }

        return view('dashboard-admin.dispensasi', [
            'users' => User::all(),
            'types' => Type::all(),
            'alasans' => Alasan::all(),
            'dispensasisKeluar' => $dispensasisKeluar,
            'dispensasisMasuk' => $dispensasisMasuk,
            'dispensasisSakit' => $dispensasisSakit,
            'dispensasisIzin' => $dispensasisIzin,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin.pengajuan',[
        'users' => User::all(),
        'types' => Type::all(),
        'alasans' => Alasan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDispensasiRequest $request)
    {
            // Mendapatkan pengguna yang sedang terotentikasi
        $user = Auth::user();

        // Pengecekan apakah pengguna sudah memiliki dispensasi atau tidak
        $existingDispensasi = Dispensasi::where('user_id', $user->id)->first();

        // Jika pengguna sudah memiliki dispensasi, redirect kembali dengan pesan error
        if ($existingDispensasi) {
            return redirect('/pengajuan')->with('error', 'You have already submitted a dispensation.');
        }

        // Jika pengguna belum memiliki dispensasi, lanjutkan dengan validasi dan penyimpanan data
        $validateData = $request->validate([
            'user_id' => 'required',
            'type_id' => 'required',
            'waktu_masuk' => 'nullable|date_format:Y-m-d\TH:i',
            'waktu_keluar' => 'nullable|date_format:Y-m-d\TH:i',
            'waktu_kembali' => 'nullable|date_format:Y-m-d\TH:i',
            'alasan_id' => 'required',
            'deskripsi' => 'nullable|max:255',
            'bukti' => 'image|file|max:2048',
        ]);

        if ($request->file('bukti')) {
            $validateData['bukti'] = $request->file('bukti')->store('dispensasi-images');
        }

        Dispensasi::create($validateData);

        return redirect('/')->with('success', 'Dispensasi has been added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Dispensasi $dispensasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispensasi $dispensasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDispensasiRequest $request, Dispensasi $dispensasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispensasi $dispensasi)
    {
        //
    }
}
