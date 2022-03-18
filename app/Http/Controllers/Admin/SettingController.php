<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Crypt;

use File;
use Intervention\Image\Facades\Image as Image;

class SettingController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/images/logo';
    }

    public function index()
    {
        $setting = Setting::first();
        return view('main_page.setting.index', get_defined_vars());
    }

    public function store(Request $request)
    {
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        $setting = Setting::where('id', $id)->first();

        $this->validate($request, [
            'title' => 'required',
            'img' => 'dimensions:max_width=350,max_height=100',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'favicon' => 'mimes:ico'
        ],[
            'title.required' => 'Title field is required.',
            'img.dimensions' => 'Logo dimension should be: Width (350px) and Height (100px).',
            'email.required'  => 'Email field is required.',
            'address.required'  => 'Address field is required.',
            'phone.numeric'  => 'Phone field must be a number.',
            'favicon.mimes' => 'Favicon field must be a ico format'
        ]);

        //UPLOAD FOTO
        if($request->file('img')){
            // File::delete($this->path . '/'. $setting->logo);
            $file = $request->file('img');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $this->fileName = 'logo' . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            $file->move($this->path,$this->fileName);
            Setting::where('id', $id)->update([
                'logo'            => $this->fileName
            ]);
        }

        if($request->file('favicon')){
            // File::delete($this->path . '/'. $setting->logo);
            $file = $request->file('favicon');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $this->fileName = 'favicon' . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            $file->move($this->path,$this->fileName);
            Setting::where('id', $id)->update([
                'favicon'            => $this->fileName
            ]);
        }

        $img = Image::make('images/logo/logo.png');
        $img->save('images/logo/logo.jpg');

        Setting::updateOrCreate([
            'id' => 1
        ], $request->all());

        return redirect()->to('main_page/setting')->with('status', 'Setting berhasil diupdate!');
    }
}
