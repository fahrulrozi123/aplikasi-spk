<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\RoomRsvpExport;
use App\Exports\ProductRsvpExport;
use App\Exports\InquiryRsvpExport;

class ReservationReportExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;

        // dd($sheets);
    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new RoomRsvpExport($this->sheets['rooms']),
            new ProductRsvpExport($this->sheets['products']),
            new InquiryRsvpExport($this->sheets['inquiry'])
        ];


        return $sheets;
    }
}

