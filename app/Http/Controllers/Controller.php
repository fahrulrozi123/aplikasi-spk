<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Model Used
use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // data profile setting
    public function setting()
    {
        return Setting::first();
    }

    // menu
    public function menu()
    {
        return [
            'room'         => PageSetting::where('page_code', 'Room')->get(),
            'recreation'   => PageSetting::where('page_code', 'Recreation')->get(),
            'spa'          => PageSetting::where('page_code', 'Spa')->get(),
            'mice'         => PageSetting::where('page_code', 'Mice')->get(),
            'wedding'      => PageSetting::where('page_code', 'Wedding')->get(),
            'functionroom' => PageSetting::where('page_code', 'Function')->get(),
            'newsletter'   => PageSetting::where('page_code', 'Newsletter')->get(),
            'contact'      => PageSetting::where('page_code', 'Contact')->get()
        ];
    }
}
