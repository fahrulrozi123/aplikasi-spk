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

class InquiryRsvpExport implements WithTitle, FromView
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->inquiry = $rows['rsvp'];
    }

    public function view(): View
    {
        return view('exports.inquiry_reservation', [
            'inquiry' => $this->inquiry
        ]);
    }

    public function title(): string
    {
        return 'Inquiry Reservation Report';
    }
}
