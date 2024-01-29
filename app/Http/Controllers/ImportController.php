<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class ImportController extends Controller
{
    public function importForm()
    {
        return view('import.form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new UserImport, $request->file('file'));

        return redirect()->route('import.form')->with('success', 'Data imported successfully!');
    }
}
