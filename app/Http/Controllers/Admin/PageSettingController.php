<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;
use App\Http\Controllers\Controller;

class PageSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $pagesetting =  PageSetting::orderBy('page_name')->get();

        return view('main_page.page_setting.index', get_defined_vars());
    }
}
