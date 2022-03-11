<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Visitor\Banner;

use Carbon\Carbon;
use Image;
use File;
use Auth;

class BannerController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = $this->setting();
        $banners = Banner::orderBy('banner_status','ASC')->get();
        return view('master_data.banner.index', get_defined_vars());
    }

    public function create()
    {
        return view('master_data.room.create');
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'img' => 'mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'img.mimes' => 'Your image format is not supported',
            'img.max' => 'Your image size cannot more than 2mb'
        ]);

        //UPLOAD FOTO
        if($request->file('img')){
            $file = $request->file('img');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                if($file->move($this->path,$this->fileName)){
                    Banner::create([
                        'banner_name' => $this->fileName,
                        'banner_status' => '4'
                    ]);
            }else{
                return redirect()->route('banner.index')->with('warning', 'gagal');
            }
        }else{
            $this->fileName = '0';
        }

        return redirect()->route('banner.index')->with('status', 'Banner Baru Berhasil di Tambahkan');
    }

    //UPDATE DATA
    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $banners = Banner::where('id', $id)->first();

        return view('master_data.banner.create', get_defined_vars());
    }

    public function update(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        $banner_status = $request['banner_status'];

        Banner::where('banner_status', $banner_status)->update([
            'banner_status'      => "4"
        ]);

        Banner::where('id', $id)->update([
            'banner_status'      => $request['banner_status']
        ]);

        return redirect()->route('banner.index')->with('status', 'Update Data Berhasil');
    }

    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        // hapus file
        $data = Banner::where('id', $id)->first();
        if(File::delete($this->path . '/'. $data->banner_name)){
            if($unit = Banner::findOrFail($id)->forceDelete()){
                return redirect()->route('banner.index')->with('status', 'Banner Berhasil Dihapus');
            }else{
                return redirect()->route('banner.index')->with('warning', 'Banner Gagal Dihapus');
            }
        }else{
            return redirect()->route('banner.index')->with('warning', 'Banner Gagal Dihapus');
        }
    }

    public function setData($id)
    {
        $id = Crypt::decryptString($id);
        $id = Banner::FindOrFail($id);
        return response()->json($id);
    }
}
