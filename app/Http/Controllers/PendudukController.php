<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;
class PendudukController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PendudukImport, $request->file('file_excel'));

        return back()->with('success', 'Data Penduduk Berhasil Diimpor!');
    }
}
