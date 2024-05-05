<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Alasan;
use App\Models\Status;
use Barryvdh\DomPDF\PDF;
use App\Models\Dispensasi;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DispensasiReject;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DispensasiApprove;
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

        // Inisialisasi variabel dispensasisKeluar dan dispensasisMasuk
        $dispensasisKeluar = null;
        $dispensasisMasuk = null;

        // Jika pengguna adalah admin, dapatkan semua data dispensasi
        if ( $user->role_id === 2) {
            $dispensasisKeluar = Dispensasi::where('type_id', 2)->get();
            $dispensasisMasuk = Dispensasi::where('type_id', 1)->get();
        }

        return view('dashboard.dispensasi.index', [
            // 'users' => User::all(),
            // 'types' => Type::all(),
            // 'alasans' => Alasan::all(),
            // 'statuses' => Status::all(),
            'dispensasisKeluar' => $dispensasisKeluar,
            'dispensasisMasuk' => $dispensasisMasuk,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  
        $user = Auth::user();
        $dispensasis = Dispensasi::where('user_id', $user->id)->get();

        return view('dashboard.pengajuan.index',[
        'users' => User::all(),
        'types' => Type::all(),
        'alasans' => Alasan::all(),
        // 'statuses' => Status::all(),
        'dispensasis' => $dispensasis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDispensasiRequest $request)
    {
        // Mendapatkan pengguna yang sedang terotentikasi
        $user = Auth::user();
    
        // Pengecekan apakah pengguna memiliki dispensasi yang masih pending
        $existingPendingDispensasi = Dispensasi::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->where('type_id', 1)->where('status_id', 1)
                        ->orWhere('type_id', 2)->whereIn('status_id', [1, 2]);
                });
        })->exists();

    
        // Jika pengguna memiliki dispensasi yang masih pending, redirect kembali dengan pesan error
        if ($existingPendingDispensasi) {
            toast()->error('Pengajuan Gagal', 'Anda tidak dapat mengajukan dispensasi baru karena masih terdapat dispensasi yang masih dalam proses.');
            return redirect('/pengajuan')->withInput();
        }
    
        // Jika pengguna tidak memiliki dispensasi yang masih pending, lanjutkan dengan validasi dan penyimpanan data
        $validateData = $request->validate([
            'user_id' => 'required',
            'type_id' => 'required',
            'waktu_masuk' => 'nullable|date_format:Y-m-d\TH:i',
            'waktu_keluar' => 'nullable|date_format:Y-m-d\TH:i',
            'waktu_kembali' => 'nullable|date_format:Y-m-d\TH:i',
            'alasan_id' => 'required',
            'deskripsi' => 'nullable|max:255',
            'bukti' => 'image|file|max:2048',
            'status_id' => 'nullable'
        ]);
    
        if ($request->file('bukti')) {
            $validateData['bukti'] = $request->file('bukti')->store('dispensasi-images');
        }
    
        Dispensasi::create($validateData);
    
        toast()->success('Pengajuan Berhasil', 'Data akan divalidasi');
        return redirect('/pengajuan')->withInput();
    }
    

    /**
     * Display the specified resource.
     */

    public function show(Dispensasi $dispensasi)
    {
        $user = auth()->user();

        // Check if the authenticated user is the owner of the dispensasi or has the role of "guru-piket"
        if ($user->id === $dispensasi->user_id && $dispensasi->status_id === 2 ||
            $user->role_id === 2) {
            return view('dashboard.dispensasi.surat.index', [
                'users' => User::all(),
                'types' => Type::all(),
                'alasans' => Alasan::all(),
                'statuses' => Status::all(),
                'dispensasis' => Dispensasi::where('id', $dispensasi->id)->get(),
                'dispensasi' => $dispensasi,
            ]);
        } else {
            // Handle unauthorized access
            toast()->error('Error', 'Anda tidak memiliki akses');
            return redirect('/')->withInput();
        }
    }

    public function detail(Dispensasi $dispensasi)
    {
        $user = auth()->user();

        // Check if the authenticated user is the owner of the dispensasi or has the role of "guru-piket"
        if (($user->role_id === 2 && $dispensasi->type_id === 1 && $dispensasi->status_id === 2) ||
            ($user->role_id === 2 && $dispensasi->type_id === 2 && $dispensasi->status_id === 4)) {
            return view('dashboard.dispensasi.show', [
                // 'users' => User::all(),
                // 'types' => Type::all(),
                // 'alasans' => Alasan::all(),
                // 'statuses' => Status::all(),
                // 'dispensasis' => Dispensasi::where('id', $dispensasi->id)->get(),
                'dispensasi' => $dispensasi,
            ]);
        } else {
            // Handle unauthorized access
            toast()->error('Error', 'Anda tidak memiliki akses');
            return redirect('/')->withInput();
        }
    }

    public function approved($id)
    {
        try {
            // Check if the authenticated user has the role of "guru-piket"
            if (auth()->user()->role_id === 2) {
                $dispensasi = Dispensasi::find($id);

                // Set waktu persetujuan
                $waktuPersetujuan = now()->setTimezone('Asia/Jakarta');

                // Check if the type is keluar
                if ($dispensasi->type_id == 2) {
                    // Calculate timer duration only if the type is keluar
                    $waktuKembali = $dispensasi->waktu_kembali;
                    $durasiTimer = strtotime($waktuKembali) - strtotime($waktuPersetujuan);
                } else {
                    // For type masuk, set the timer duration to null
                    $durasiTimer = null;
                }

                // Update columns waktu_persetujuan and durasi_timer
                $dispensasi->update([
                    'status_id' => 2,
                    'waktu_persetujuan' => $waktuPersetujuan,
                    'durasi_timer' => $durasiTimer
                ]);

                // Mengirim notifikasi setelah dispensasi disetujui
                $dispensasi->user->notify(new DispensasiApprove($dispensasi));

                toast()->success('Berhasil', 'Dispensasi telah disetujui');
                return redirect('/dispensasi')->withInput();
            } else {
                toast()->error('Gagal', 'Anda tidak bisa menyetujui dispensasi');
                return redirect('/')->withInput();
            }
        } catch (\Exception $e) {
            toast()->error('Gagal', 'Gagal Menyetujui Dispensasi');
            return redirect('/')->withInput();
        }
    }

    // public function rejected( Request $request, $id)
    // {
    //     try {
    //         // Check if the authenticated user has the role of "guru-piket"
    //         if (auth()->user()->role_id === 2) {
    //             // Fetch the dispensasi data
    //             $dispensasi = Dispensasi::find($id);
    
    //             // Assuming status_id 3 is for rejected status
    //             $dispensasi->update([
    //                 'status_id' => 3
    //             ]);
    
    //             // Delete the associated image
    //             if ($dispensasi->bukti) {
    //                 Storage::delete($dispensasi->bukti);
    //             }
                
    //             // Mengirim notifikasi setelah dispensasi ditolak
    //             $pesanReject = request('pesan_reject', 'Dispensasi Ditolak');

    //             $dispensasi->user->notify(new DispensasiReject($dispensasi, $pesanReject));

    //             // Delete the dispensasi data
    //             $dispensasi->delete();
                
    //             toast()->success('Berhasil', 'Dispensasi berhasil di tolak');
    //             return redirect('/')->withInput();
    //         } else {
    //             toast()->error('Gagal', 'Anda tidak bisa menolak dispensasi');
    //             return redirect('/')->withInput();
    //         }
    //     } catch (\Exception $e) {
    //         toast()->error('Gagal', 'Gagal menolak dispensasi');
    //         return redirect('/')->withInput();
    //     }
    // }

    public function rejected(Request $request, $id)
    {
        try {
            // Check if the authenticated user has the role of "guru-piket"
            if (auth()->user()->role_id === 2) {
                // Fetch the dispensasi data
                $dispensasi = Dispensasi::find($id);

                // Assuming status_id 3 is for rejected status
                $dispensasi->update([
                    'status_id' => 3,
                    'waktu_persetujuan' => now()->setTimezone('Asia/Jakarta') // Set the waktu_persetujuan
                ]);

                // Mengirim notifikasi setelah dispensasi ditolak
                $pesanReject = request('pesan_reject', 'Dispensasi Ditolak');

                $dispensasi->user->notify(new DispensasiReject($dispensasi, $pesanReject));
                // Delete the associated image
                if ($dispensasi->bukti) {
                    Storage::delete($dispensasi->bukti);
                }

                toast()->success('Berhasil', 'Dispensasi berhasil ditolak');
            } else {
                toast()->error('Gagal', 'Anda tidak bisa menolak dispensasi');
            }
        } catch (\Exception $e) {
            toast()->error('Gagal', 'Gagal menolak dispensasi');
        }

        // Delete the dispensasi data after sending notification
        if (isset($dispensasi)) {
            $dispensasi->delete();
        }

        return redirect('/')->withInput();
    }

    public function downloadPdf(Dispensasi $dispensasi)
    {
        $user = auth()->user();

        // Check if the user is the owner of the dispensasi, has the role of "guru-piket", or if dispensasi is approved
            if ($user->id === $dispensasi->user_id && 
                (($dispensasi->type_id === 1 && $dispensasi->status_id === 2) || 
                ($dispensasi->type_id === 2 && $dispensasi->status_id === 4)) || 
                $user->role_id === 2){
            
            $pdf = app(PDF::class);
            $pdf->loadView('dashboard.dispensasi.surat.index', [
                'dispensasis' => Dispensasi::where('id', $dispensasi->id)->get(),
                'dispensasi' => $dispensasi
            ]);

            return $pdf->download('dispensasi.pdf');
        } else {
            // Handle unauthorized access
            toast()->error('Gagal', 'Anda tidak memiliki akses');
            return redirect('/')->withInput();
        }
    }

    public function done(Request $request, $id)
    {
        try {
            // Check if the authenticated user has the role of "guru-piket"
            if (auth()->user()->role_id === 2) {
                $dispensasi = Dispensasi::find($id);

                // Check if the dispensasi is already marked as done
                if ($dispensasi->status_id === 4) { // Assuming 4 is the status for "Done"
                    toast()->warning('Peringatan', 'Dispensasi sudah selesai.');
                    return redirect('/dispensasi')->withInput();
                }

                // Mark the dispensasi as done and save the end time
                $waktuSelesai = now()->setTimezone('Asia/Jakarta');
                $dispensasi->update([
                    'status_id' => 4, // Assuming 4 is the status for "Done"
                    'waktu_selesai' => $waktuSelesai,
                ]);

                toast()->success('Berhasil', 'Dispensasi telah selesai.');
                return redirect('/dispensasi')->withInput();
            } else {
                toast()->error('Gagal', 'Anda tidak bisa menyelesaikan dispensasi.');
                return redirect('/')->withInput();
            }
        } catch (\Exception $e) {
            toast()->error('Gagal', 'Gagal menyelesaikan dispensasi.');
            return redirect('/')->withInput();
        }
    }
    
    public function destroy(Dispensasi $dispensasi)
    {
        if($dispensasi->bukti){
            Storage::delete($dispensasi->bukti);
        }

        Dispensasi::destroy ($dispensasi->id);

        alert()->success('Success', 'Dispensasi Berhasil dihapus');
        return redirect('/')->withInput();
    }
    
    public function edit(Dispensasi $dispensasi)
    { 
        return view('dashboard.dispensasi.edit',[
            'dispensasi' => $dispensasi,
            'users' => User::all(),
            'types' => Type::all(),
            'alasans' => Alasan::all(),
            // 'statuses' => Status::all(),
        ]);
    }

    public function update(UpdateDispensasiRequest $request, Dispensasi $dispensasi)
    {
        try {
            $rules = [
                'user_id' => 'required',
                'type_id' => 'required',
                'waktu_masuk' => 'nullable|date_format:Y-m-d\TH:i',
                'waktu_keluar' => 'nullable|date_format:Y-m-d\TH:i|before_or_equal:waktu_kembali|before_or_equal:waktu_selesai|before_or_equal:waktu_persetujuan',
                'waktu_kembali' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:waktu_keluar|after_or_equal:waktu_persetujuan',
                'waktu_selesai' => 'nullable|date',
                'waktu_persetujuan' => 'nullable|date',
                'alasan_id' => 'required',
                'deskripsi' => 'nullable|max:255',
                'bukti' => 'image|file|max:2048',
                'status_id' => 'nullable'
            ];
        
            $validateData = $request->validate($rules);
        
            // Simpan path gambar lama
            $oldImagePath = $dispensasi->bukti;
        
            if ($request->file('bukti')) {
                // Hapus gambar lama
                if ($oldImagePath) {
                    Storage::delete($oldImagePath);
                }
        
                // Simpan gambar baru
                $validateData['bukti'] = $request->file('bukti')->store('dispensasi-images');
            } else {
                // Hapus aturan validasi gambar jika tidak ada gambar baru yang diunggah
                unset($validateData['bukti']);
            }
        
            $dispensasi->update($validateData);
        
            alert()->success('Success', 'Dispensasi Berhasil diubah');
            return redirect('/')->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            alert()->error('error', 'Waktu tidak sesuai');
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    
}
