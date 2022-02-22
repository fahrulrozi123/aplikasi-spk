<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\FunctionRoom\FunctionPhotos;
use App\Models\FunctionRoom\FunctionRoom;
use App\Models\Inquiry\Inquiry;

use Carbon\Carbon;
use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FuncRoomController extends Controller
{

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $setting = $this->setting();

        $function_rooms = FunctionRoom::with('partition')->with('photos')->where('func_head', null)->orderBy('create_at', 'DESC')->get();
        if (count($function_rooms) > 0) {
            return view('master_data.function_room.indexisi', get_defined_vars());
        } else {
            return view('master_data.function_room.index', get_defined_vars());
        }
    }

    public function create()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $setting = $this->setting();

        return view('master_data.function_room.create', get_defined_vars());
    }

    public function insert(Request $request)
    {
        if ($request['form_action'] == "update") {
            $this->validate($request, [
                'func_name' => 'required',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048',
                'img' => 'required_without:oldImg'
            ],
            [
                'img.required_without' => 'Function Room photos cannot be empty',
                'img.*.mimes' => 'Your image format is not supported',
                'img.*.max' => 'Your image size cannot more than 2mb'
            ]);

            $this->update($request);
            return redirect()->route('function_room.index')->with('status', 'Function Room Berhasil di Update');
        } elseif ($request['form_action'] == "delete") {
            $this->delete($request);
            return redirect()->route('function_room.index')->with('status', 'Data Function Room Berhasil Dihapus');
        } else if ($request['form_action'] == "create") {
            $this->validate($request, [
                'func_name' => 'required',
                'img' => 'required',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'img.required' => 'Function Room photo cannot be empty.',
                'img.*.mimes' => 'Your image format is not supported.',
                'img.*.max' => 'Your image size cannot more than 2mb.'
            ]);

            //CREATE ID
            $bytes = openssl_random_pseudo_bytes(4, $cstrong);
            $hex = bin2hex($bytes);
            $id = $hex;

            while (FunctionRoom::where('id', $id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $id = $hex;
            }

            $slug = $this->createSlug(($request['func_name']));

            FunctionRoom::create([
                'id' => $id,
                'func_name' => $request['func_name'],
                'func_room_slug' => $slug,
                'func_room_desc' => $request['func_room_desc'],
                'func_dimension' => $request['func_dimension'],
                'func_class' => $request['func_class'],
                'func_theatre' => $request['func_theatre'],
                'func_ushape' => $request['func_ushape'],
                'func_board' => $request['func_board'],
                'func_round' => $request['func_round'],
                'func_head' => null,
                'func_publish_status' =>  1
            ]);

            if (isset($request['partition_name'])) {
                $partition_data = array();
                for ($index = 0; $index < count($request['partition_name']); $index++) {
                    //CREATE ID
                    $partition_id = rand($min = 1, $max = 9999);
                    $cek = FunctionRoom::where('id', $partition_id)->get();

                    //GENERATE NEW ID IF EXIST
                    while (count($cek) > 0) {
                        $partition_id = rand($min = 1, $max = 9999);
                        $cek = FunctionRoom::where('id', $partition_id)->get();
                    }
                    $row = array(
                        'id' => $partition_id,
                        'func_name' => $request['partition_name'][$index],
                        'func_room_desc' => "",
                        'func_dimension' => $request['partition_dimension'][$index],
                        'func_class' => $request['partition_class'][$index],
                        'func_theatre' => $request['partition_theatre'][$index],
                        'func_ushape' => $request['partition_ushape'][$index],
                        'func_board' => $request['partition_board'][$index],
                        'func_round' => $request['partition_round'][$index],
                        'func_head' => $id,
                        'func_publish_status' =>  0
                    );
                    array_push($partition_data, $row);
                }
                FunctionRoom::insert($partition_data);
            }

            //UPLOAD FOTO
            if ($request->file('img')) {
                $data = array();
                $temp = array();
                foreach ($request->file('img') as $file) {
                    //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                    if ($file->move($this->path, $this->fileName)) {
                        $temp = array('function_room_id' => $id, 'photo_path' => $this->fileName);
                        array_push($data, $temp);
                    }
                }
                FunctionPhotos::insert($data);
            }

            return redirect()->route('function_room.index')->with('status', 'Function Room Baru Berhasil di Tambahkan');
        }
    }

    //UPDATE DATA
    public function edit($id)
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $setting = $this->setting();

        $id = Crypt::decryptString($id);
        $function_room = FunctionRoom::with('partition')->with('photos')->where('id', $id)->first();
        return view('master_data.function_room.create', get_defined_vars());
    }

    public function update($request)
    {
        $id = Crypt::decryptString($request['id']);
        $temp_photo = FunctionPhotos::where('function_room_id', $id)->get();
        FunctionPhotos::where('function_room_id', $id)->forceDelete();

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
                $temp = array('function_room_id' => $id, 'photo_path' => $this->fileName);
                array_push($data, $temp);
            }
            FunctionPhotos::insert($data);
        }

        //UPDATE DATA
        FunctionRoom::where('id', $id)->update(['func_room_slug' => null]);
        $slug = $this->createSlug(($request['func_name']));

        if (isset($request['func_publish_status'])) {
            $this->func_publish_status = '1';
        } else {
            $this->func_publish_status = '0';
        }

        FunctionRoom::where('id', $id)->update([
            'func_name' => $request['func_name'],
            'func_room_slug' => $slug,
            'func_room_desc' => $request['func_room_desc'],
            'func_dimension' => $request['func_dimension'],
            'func_class' => $request['func_class'],
            'func_theatre' => $request['func_theatre'],
            'func_ushape' => $request['func_ushape'],
            'func_board' => $request['func_board'],
            'func_round' => $request['func_round'],
            'func_head' => null,
            'func_publish_status' =>  $this->func_publish_status
        ]);

        if (isset($request['partition_name'])) {
            FunctionRoom::where('func_head', $id)->forceDelete();
            $partition_data = array();
            for ($index = 0; $index < count($request['partition_name']); $index++) {
                //CREATE ID
                $partition_id = rand($min = 1, $max = 9999);
                $cek = FunctionRoom::where('id', $partition_id)->get();

                //GENERATE NEW ID IF EXIST
                while (count($cek) > 0) {
                    $partition_id = rand($min = 1, $max = 9999);
                    $cek = FunctionRoom::where('id', $partition_id)->get();
                }
                $row = array(
                    'id' => $partition_id,
                    'func_name' => $request['partition_name'][$index],
                    'func_room_desc' => "",
                    'func_dimension' => $request['partition_dimension'][$index],
                    'func_class' => $request['partition_class'][$index],
                    'func_theatre' => $request['partition_theatre'][$index],
                    'func_ushape' => $request['partition_ushape'][$index],
                    'func_board' => $request['partition_board'][$index],
                    'func_round' => $request['partition_round'][$index],
                    'func_head' => $id,
                    'func_publish_status' =>  0
                );
                array_push($partition_data, $row);
            }
            FunctionRoom::insert($partition_data);
        }

    }

    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        if(Inquiry::where('function_room_id', $id)->exists()){
            return redirect()->back()->with('warning', 'Function Room cannot be delete because it has inquiry');
        }

        $temp_photo = FunctionPhotos::where('function_room_id', $id)->get();
        FunctionPhotos::where('function_room_id', $id)->forceDelete();
        FunctionRoom::where('id', $id)->forceDelete();

        foreach ($temp_photo as $img) {
            File::delete($this->path . '/' . $img->product_photo_path);
        }

        return redirect()->route('function_room.index')->with('status', 'Data Function Room Berhasil Dihapus');
    }

    //CREATE SLUG
    public function createSlug($title)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug);
        if (! $allSlugs->contains('func_room_slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('func_room_slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug)
    {
        return FunctionRoom::select('func_room_slug')->where('func_room_slug', 'like', $slug.'%')->get();
    }

}
