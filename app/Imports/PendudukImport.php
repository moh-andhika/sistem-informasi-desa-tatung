<?php

namespace App\Imports;

use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PendudukImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        return new Penduduk([
            'no_kk' => $row['no_kk'],
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jk'],
            'tempat_lahir' => $row['tmpt_lhr'],
            // Mengonversi format 03-05-1970 (Excel) ke 1970-05-03 (Database)
            'tanggal_lahir' => Carbon::createFromFormat('d-m-Y', $row['tgl_lhr'])->format('Y-m-d'),
            'alamat' => $row['alamat'],
            'no_rt' => $row['no_rt'],
            'no_rw' => $row['no_rw'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nik';
    }
}
