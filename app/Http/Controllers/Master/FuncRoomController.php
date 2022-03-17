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

        $function_rooms = FunctionRoom::with('partition')->with('photos')->where('func_head', null)->orderBy('created_at', 'DESC')->get();
        // dd($function_rooms);
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
        // dd($request->all());
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

            if (isset($request['partition'])) {
                $resultPartitions = $request['partition'];

                foreach ($resultPartitions as $resultPartition) {
                    //CREATE ID
                    $partition_id = rand($min = 1, $max = 9999);
                    $cek = FunctionRoom::where('id', $partition_id)->get();

                    //GENERATE NEW ID IF EXIST
                    while (count($cek) > 0) {
                        $partition_id = rand($min = 1, $max = 9999);
                        $cek = FunctionRoom::where('id', $partition_id)->get();
                    }

                    FunctionRoom::create([
                        'id' => $partition_id,
                        'func_name' => $resultPartition['partition_name'],
                        'func_room_desc' => "",
                        'func_dimension' => $resultPartition['partition_dimension'],
                        'func_class' => $resultPartition['partition_class'],
                        'func_theatre' => $resultPartition['partition_theatre'],
                        'func_ushape' => $resultPartition['partition_ushape'],
                        'func_board' => $resultPartition['partition_board'],
                        'func_round' => $resultPartition['partition_round'],
                        'func_head' => $id,
                        'func_publish_status' =>  1
                    ]);
                }
            }

            //UPLOAD FOTO
            if ($request->file('img')) {
                foreach ($request->file('img') as $file) {
                    //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                    if ($file->move($this->path, $this->fileName)) {
                        FunctionPhotos::create([
                            'function_room_id' => $id,
                            'photo_path' => $this->fileName,
                        ]);
                    }
                }
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
        // dd($request->all());
        $id = Crypt::decryptString($request['id']);
        $temp_photo = FunctionPhotos::where('function_room_id', $id)->get();

        if ($request['oldImg']) {
            foreach ($request['oldImg'] as $img) {
                $this->fileName = $img;
                $checkPhotoTypes =  FunctionPhotos::where('photo_path', $this->fileName)->first();

                if($checkPhotoTypes != null){
                    FunctionPhotos::where('photo_path', $this->fileName)->update([
                        'function_room_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }

            $imgPhotoOld = $request['oldImg'];
            $imgPhoto = FunctionPhotos::where('function_room_id', $id)->pluck('photo_path')->toArray();
            $array = array_diff($imgPhoto, $imgPhotoOld);
            foreach ($array as $img) {
                File::delete($this->path . '/' . $img);
            }
            FunctionPhotos::where('function_room_id', $id)->whereNotIn('photo_path', $request['oldImg'])->forceDelete();
        }

        //UPLOAD FOTO
        if ($request->file('img')) {
            foreach ($request->file('img') as $file) {
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                if ($file->move($this->path, $this->fileName)) {
                    FunctionPhotos::create([
                        'function_room_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }
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

        if (isset($request['partition'])) {
            $resultPartitions = $request['partition'];
            // dd($resultPartitions);
            $collectPartition = [];

            foreach ($resultPartitions as $resultPartition) {
                if($resultPartition['partition_id'] != null) {
                    array_push($collectPartition, $resultPartition['partition_id']);
                }
            }

            // Delete Function Partition
            FunctionRoom::whereNotNull('func_head')->whereNotIn('id', $collectPartition)->forceDelete();

            foreach ($resultPartitions as $resultPartition) {

                // if($resultPartition['partition_id'] != null) {
                //     array_push($collectPartition, $resultPartition['partition_id']);
                // }

                $checkPartitionName =  FunctionRoom::where('id', $resultPartition['partition_id'])->first();

                if($checkPartitionName != null){
                    FunctionRoom::where('id', $resultPartition['partition_id'])->update([
                        'func_name' => $resultPartition['partition_name'],
                        'func_room_desc' => "",
                        'func_dimension' => $resultPartition['partition_dimension'],
                        'func_class' => $resultPartition['partition_class'],
                        'func_theatre' => $resultPartition['partition_theatre'],
                        'func_ushape' => $resultPartition['partition_ushape'],
                        'func_board' => $resultPartition['partition_board'],
                        'func_round' => $resultPartition['partition_round'],
                        'func_head' => $id,
                        'func_publish_status' =>  $this->func_publish_status
                    ]);
                } else {
                    // dd('masuk sini');
                    //CREATE ID
                    $partition_id = rand($min = 1, $max = 9999);
                    $cek = FunctionRoom::where('id', $partition_id)->get();

                    //GENERATE NEW ID IF EXIST
                    while (count($cek) > 0) {
                        $partition_id = rand($min = 1, $max = 9999);
                        $cek = FunctionRoom::where('id', $partition_id)->get();
                    }

                    FunctionRoom::create([
                        'id' => $partition_id,
                        'func_name' => $resultPartition['partition_name'],
                        'func_room_desc' => "",
                        'func_dimension' => $resultPartition['partition_dimension'],
                        'func_class' => $resultPartition['partition_class'],
                        'func_theatre' => $resultPartition['partition_theatre'],
                        'func_ushape' => $resultPartition['partition_ushape'],
                        'func_board' => $resultPartition['partition_board'],
                        'func_round' => $resultPartition['partition_round'],
                        'func_head' => $id,
                        'func_publish_status' =>  1
                    ]);
                }
            }
        } else {
            FunctionRoom::where('func_head', $id)->forceDelete();
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
        FunctionRoom::where('func_head', $id)->forceDelete();

        foreach ($temp_photo as $img) {
            File::delete($this->path . '/' . $img->photo_path);
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
