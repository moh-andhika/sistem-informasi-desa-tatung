<?php

namespace App\Http\Controllers;

use App\Imports\PendudukImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        Excel::import(new PendudukImport, $request->file('file_excel'));

        return back()->with('success', 'Data Penduduk Berhasil Diimpor!');
    }
}
