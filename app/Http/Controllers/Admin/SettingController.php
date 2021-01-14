<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Crypt;

// use Image;
use File;
use Intervention\Image\ImageManagerStatic as Image;

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
        // dd($request->all());
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        $setting = Setting::where('id', $id)->first();

        $this->validate($request, [
            'title' => 'required',
            // 'img' => 'dimensions:max_width=350,max_height=100',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'wa_number' => 'numeric',
            'address' => 'required'
        ],[
            'title.required' => 'Title field is required.',
            // 'img.dimensions' => 'Logo dimension should be: Width (350px) and Height (100px).',
            'email.required'  => 'Email field is required.',
            'phone.required'  => 'Phone field is required.',
            'address.required'  => 'Address field is required.',
            'phone.numeric'  => 'Phone field must be a number.',
            'wa_number.numeric'  => 'Whatsapp field must be a number.'
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

        $img = Image::make('images/logo/logo.png');
        $img->save('images/logo/logo.jpg');

        Setting::updateOrCreate([
            'id' => 1
        ], $request->all());

        return redirect()->to('main_page/setting')->with('status', 'Setting berhasil diupdate!');
    }
}
