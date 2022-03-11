<?php

namespace App\Http\Controllers\Admin;

use File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Models\Setting\PagePhoto;
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
        $pagesettings =  PageSetting::orderBy('id', 'ASC')->with('photo')->get();

        return view('main_page.page_setting.index', get_defined_vars());
    }

    public function edit($id)
    {
        $setting = Setting::first();
        $pagesetting = PageSetting::where('id', $id)->with('photo')->first();

        return view('main_page.page_setting.edit', get_defined_vars());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'page_name'                 => 'required',
            'page_description'          => 'required',
            'oldImg'                    => 'required'
        ],[
            'page_name.required'        => 'Page Name field is required.',
            'page_description.required' => 'Page Description field is required.',
            'oldImg.required'           => 'Upload at least 1 photo to be shown.'
        ]);

        $id = $request['id'];
        if ($request['oldImg']) {
            foreach ($request['oldImg'] as $img) {
                $this->fileName = $img;
                $checkPhotoTypes =  PagePhoto::where('photo_path', $this->fileName)->first();

                if($checkPhotoTypes != null){
                    PagePhoto::where('photo_path', $this->fileName)->update([
                        'page_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }

            $imgPhotoOld = $request['oldImg'];
            $imgPhoto = PagePhoto::where('page_id', $id)->pluck('photo_path')->toArray();
            $array = array_diff($imgPhoto, $imgPhotoOld);
            foreach ($array as $img) {
                File::delete($this->path . '/' . $img);
            }
            PagePhoto::where('page_id', $id)->whereNotIn('photo_path', $request['oldImg'])->forceDelete();
        }

        //UPLOAD FOTO
        if ($request->file('img')) {
            foreach ($request->file('img') as $file) {
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                if ($file->move($this->path, $this->fileName)) {
                    PagePhoto::create([
                        'page_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }
        }

        PageSetting::where('id', $id)->update([
            'page_name'        => $request['page_name'],
            'page_description' => $request['page_description']
        ]);

        return redirect()->route('page_setting.index')->with('status', 'Page Setting berhasil diupdate!');
    }
}
