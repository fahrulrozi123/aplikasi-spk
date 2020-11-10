<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use App\Models\Setting\PagePhoto;
use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;
use App\Http\Controllers\Controller;

class PageSettingController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = Setting::first();
        $pagesettings =  PageSetting::orderBy('page_name')->with('photo')->get();

        return view('main_page.page_setting.index', get_defined_vars());
    }

    public function edit($id)
    {
        $setting = Setting::first();
        $pagesetting = PageSetting::findOrFail($id);

        return view('main_page.page_setting.edit', get_defined_vars());
    }

    public function store(Request $request)
    {
        // dd($request['id']);
        // dd($request->all());
        // $setting = Setting::first();
        $id = $request['id'];
        // $id = Crypt::decryptString($requestid);
        // $pagesetting = PageSetting::where('id', $id)->first();

        // $user = PageSetting::findOrFail($id);


        $this->validate($request, [
            'page_name' => 'required',
            'page_description' => 'required',
            // 'page_code' => 'required'
        ],[
            'page_name.required'  => 'Page Name field is required.',
            'page_description.required'  => 'Page Description field is required.',
            // 'so_instagram.required'  => 'Instagram Address field is required.'
        ]);

        //UPLOAD FOTO
        // if($request->file('img')){
        //     // File::delete($this->path . '/'. $setting->logo);
        //     $file = $request->file('img');
        //     //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        //     $this->fileName = 'logo' . '.' . $file->getClientOriginalExtension();
        //     //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        //     $file->move($this->path,$this->fileName);
        //     Setting::where('id', $id)->update([
        //         'logo'            => $this->fileName
        //     ]);
        // }

        PageSetting::where('id', $id)->update([
            'page_name'        => $request['page_name'],
            'page_description' => $request['page_description']
        ]);

        return redirect()->route('page_setting.index')->with('status', 'Page Setting berhasil diupdate!');
    }
}
