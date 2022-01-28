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
        $temp_photo = PagePhoto::where('page_id', $id)->get();
        PagePhoto::where('page_id', $id)->forceDelete();

        if ($request['oldImg']) {
            foreach ($temp_photo as $img) {
                $check = false;
                foreach ($request['oldImg'] as $oldImg) {
                    if ($oldImg == $img->photo_path) {
                        $check = true;
                        break;
                    }
                }
                if (!$check) {
                    if (file_exists($this->path . '/' . $img->photo_path)) {
                        File::delete($this->path . '/' . $img->photo_path);
                    }
                }
            }
        }

        if ($request['oldImg']) {
            $data = array();
            $temp = array();
            $no = 0;
            foreach ($request['oldImg'] as $img) {
                if ($img == "new") {
                    $file = $request->file('img')[$no];
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($this->path, $this->fileName);
                    $no++;
                } else {
                    $this->fileName = $img;
                }
                $temp = array('page_id' => $id, 'photo_path' => $this->fileName);
                array_push($data, $temp);
            }
            PagePhoto::insert($data);
        }

        PageSetting::where('id', $id)->update([
            'page_name'        => $request['page_name'],
            'page_description' => $request['page_description']
        ]);

        return redirect()->route('page_setting.index')->with('status', 'Page Setting berhasil diupdate!');
    }
}
