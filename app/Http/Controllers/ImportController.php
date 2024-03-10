<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class ImportController extends Controller
{
    public function importForm()
    {
        return view('dashboard.users.register.excel');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            Excel::import(new UserImport, $request->file('file'));
            toast()->success('Register Berhasil', 'Data berhasil dimasukan');
        } catch (\Exception $e) {
            toast()->error('Register Gagal', 'Harap cek kembali data yang anda masukan');
        }

        return redirect()->route('register.excel');
    }
}
