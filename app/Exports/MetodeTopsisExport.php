<?php

namespace App\Exports;

use App\Model\Mahasiswa;
use illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class MetodeTopsisExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    // public function collection()
    // {
    //     return Mahasiswa::all();
    // }

    private $mahasiswa;

    public function _construct()
    {
        $this->mahasiswa = Mahasiswa::all();
    }

    public function view() : View
    {
        return view('export.hasilrekomendasi_excel', [
            'mahasiswa' => $this->mahasiswa
        ]);
    }

}
