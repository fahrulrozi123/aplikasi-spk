<?php

namespace App\Exports;

use App\Model\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class MetodeTopsisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::all();
    }
}
