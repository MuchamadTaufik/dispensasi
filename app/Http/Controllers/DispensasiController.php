<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dispensasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDispensasiRequest;
use App\Http\Requests\UpdateDispensasiRequest;

class DispensasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan pengguna yang sedang terotentikasi
    $user = Auth::user();

    // Inisialisasi variabel dispensasis
    $dispensasis = null;

    // Jika pengguna adalah admin, dapatkan semua data dispensasi
    if ($user->role_id === 1 || $user->role_id === 2 ) {
        $dispensasis = Dispensasi::all();
    } else {
        // Jika pengguna bukan admin, hanya dapatkan data dispensasi yang terkait dengan pengguna
        $dispensasis = Dispensasi::where('user_id', $user->id)->get();
    }

    return view('dashboard-admin.dispensasi', [
        'users' => User::all(),
        'dispensasis' => $dispensasis,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin.pengajuan',[
        'users' => User::all()
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
            'jam_keluar' => 'required|date_format:Y-m-d\TH:i',
            'jam_kembali' => 'required|date_format:Y-m-d\TH:i',
            'alasan' => 'required|max:255',
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
