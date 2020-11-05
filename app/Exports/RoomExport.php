<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RoomExport implements WithTitle, FromView
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->room = $rows['room'];
        $this->rsvp = $rows['rsvp'];
    }

    public function view(): View
    {
        return view('exports.room_sales', [
            'room' => $this->room,
            'rsvp' => $this->rsvp
        ]);
    }

    public function title(): string
    {
        return 'Reservation Sales Report';
    }

}
