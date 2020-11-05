<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;

class ReportController extends Controller
{
    // data profile setting
    public function setting()
    {
        return Setting::first();
    }

    public function report()
    {
        $setting = $this->setting();
        return view('main_page.report.index', get_defined_vars());
    }

    public function reservation_report()
    {
        $setting = $this->setting();
        return view('main_page.reservation_report.index', get_defined_vars());
    }

    public function customer_report()
    {
        $setting = $this->setting();
        return view('main_page.cust_report.index', get_defined_vars());
    }

    public function allotment_report()
    {
        $setting = $this->setting();
        return view('main_page.allotment_report.index', get_defined_vars());
    }
}
