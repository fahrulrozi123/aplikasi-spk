<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\RoomExport;
use App\Exports\ProductExport;

class SalesReportExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;

    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new RoomExport($this->sheets['rooms']),
            new ProductExport($this->sheets['products'])
        ];


        return $sheets;
    }
}

