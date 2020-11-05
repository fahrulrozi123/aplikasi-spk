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

class ProductExport implements WithTitle, FromView
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->product = $rows['product'];
        $this->rsvp = $rows['rsvp'];
    }

    public function view(): View
    {
        return view('exports.product_sales', [
            'product' => $this->product,
            'rsvp' => $this->rsvp
        ]);
    }

    public function title(): string
    {
        return 'Product Sales Report';
    }
}
