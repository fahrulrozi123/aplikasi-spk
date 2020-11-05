<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;


class AllotmentExport implements FromView, WithTitle
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->allotment = $rows['allotment'];
    }
    public function view(): View
    {
        return view('exports.allotment', [
            'allotment' => $this->allotment
        ]);
    }

    public function title(): string
    {
        return 'Allotment Report';
    }
}