<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Amenities\Amenities;
use App\Models\Room\Photo;
use App\Models\Room\RoomAmenities;
use App\Models\Room\Type;
use App\Models\Room\Rsvp;
use App\Models\Room\Bed;
use Carbon\Carbon;
use DB;

use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RoomController extends Controller
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

        $room_id = Type::orderBy('room_order', 'ASC')->pluck('id')->toArray();
        $rooms = Type::orderBy('room_order', 'ASC')->with('bed')->with('amenities')->with('photo')->get();
        if (count($rooms) > 0) {
            return view('master_data.room.indexisi', get_defined_vars());
        } else {
            return view('master_data.room.index', get_defined_vars());
        }
    }

    public function data()
    {
        $rooms = Type::orderBy('room_order', 'ASC')->with('allotment')->get();
        return $rooms;
    }

    public function create()
    {
        $setting = $this->setting();
        $amenitiess = Amenities::orderBy('id')->get();
        return view('master_data.room.create', get_defined_vars());
    }

    public function insert(Request $request)
    {
        if ($request->id != "") {
            $this->validate($request, [
                'room_name' => 'required',
                'room_desc' => 'required',
                'bed_type' => 'required',
                'room_allotment' => 'required',
                'room_publish_rate' => 'required',
                'room_ro_rate' => 'required',
                'room_weekend_rate' => 'required',
                'room_weekend_ro_rate' => 'required',
                'room_extrabed_rate' => 'required',
                'room_future_availability' => 'required',
                'room_order' => 'required|integer|min:1|max:100',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048',
                'img' => 'required_without:oldImg'
            ],
            [   'img.required_without' => 'Room photo cannot be empty',
                'img.*.max' => 'Your image size cannot more than 2mb',
                'img.*.mimes' => 'Your image format is not supported',
                'room_order.integer' => 'The room list order must be an number.',
            ]);
            $this->update($request);
        } else {
            $this->validate($request, [
                'room_name' => 'required',
                'room_desc' => 'required',
                'bed_type' => 'required',
                'room_allotment' => 'required',
                'room_publish_rate' => 'required',
                'room_ro_rate' => 'required',
                'room_weekend_rate' => 'required',
                'room_weekend_ro_rate' => 'required',
                'room_extrabed_rate' => 'required',
                'room_future_availability' => 'required',
                'room_order' => 'required|integer|min:1|max:100',
                'img' => 'required',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048|required'
            ],
            [
                'img.required' => 'Room photo cannot be empty',
                'img.*.mimes' => 'Room photos format is not supported',
                'img.*.max' => 'Your image size cannot more than 2mb',
                'room_order.integer' => 'The room list order must be an number.',
            ]);

            //CREATE ID
            $bytes = openssl_random_pseudo_bytes(4, $cstrong);
            $hex = bin2hex($bytes);
            $id = $hex;
            while (Type::where('id', $id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $id = $hex;
            }

            $slug = $this->createSlug(($request['room_name']));

            Type::create([
                'id'        => $id,
                'room_name' => $request['room_name'],
                'room_slug' => $slug,
                'room_desc' => $request['room_desc'],
                'room_allotment' => $request['room_allotment'],
                'room_publish_rate' => $request['room_publish_rate'],
                'room_ro_rate' => $request['room_ro_rate'],
                'room_weekend_rate' => $request['room_weekend_rate'],
                'room_weekend_ro_rate' => $request['room_weekend_ro_rate'],
                'room_extrabed_rate' => $request['room_extrabed_rate'],
                'room_future_availability' => $request['room_future_availability'],
                'room_order' => $request['room_order']
            ]);

            //UPLOAD FOTO
            if ($request->file('img')) {
                foreach ($request->file('img') as $file) {
                    //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                    if ($file->move($this->path, $this->fileName)) {
                        Photo::create([
                            'room_id' => $id,
                            'photo_path' => $this->fileName
                        ]);
                    }
                }
            }

            if ($request['room_amenities']) {
                $amenitiess = $request['room_amenities'];
                foreach ($amenitiess as $amenities) {
                    RoomAmenities::create([
						'room_id' => $id,
                        'amenities_id' => $amenities
					]);
                }
            }

            if ($request['bed_type']) {
                $bed_types = $request['bed_type'];
                foreach ($bed_types as $bed_type) {
                    Bed::create([
						'room_id' => $id,
                        'bed_id' => $bed_type
					]);
                }
            }

            return redirect()->route('room.index')->with('status', 'Room Baru Berhasil di Tambahkan');
        }
        return redirect()->route('room.index')->with('status', 'Update Data Room Berhasil');
    }

    //UPDATE DATA
    public function edit($id)
    {
        $setting = $this->setting();
        $amenitiess = Amenities::orderBy('id')->get();
        $id = Crypt::decryptString($id);
        $room = Type::where('id', $id)->orderBy('room_name')->with('bed')->with('amenities')->with('photo')->first();
        return view('master_data.room.create', get_defined_vars());
    }

    private function update($request)
    {
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        RoomAmenities::where('room_id', $id)->forceDelete();
        Bed::where('room_id', $id)->forceDelete();

        if ($request['room_amenities']) {
            $amenitiess = $request['room_amenities'];
            foreach ($amenitiess as $amenities) {
                RoomAmenities::create([
                    'room_id' => $id,
                    'amenities_id' => $amenities
                ]);
            }
        }

        if ($request['bed_type']) {
            $bed_types = $request['bed_type'];
            foreach ($bed_types as $bed_type) {
                Bed::create([
                    'room_id' => $id,
                    'bed_id' => $bed_type
                ]);
            }
        }

        if ($request['oldImg']) {
            foreach ($request['oldImg'] as $img) {
                $this->fileName = $img;
                $checkPhotoTypes =  Photo::where('photo_path', $this->fileName)->first();

                if($checkPhotoTypes != null){
                    Photo::where('photo_path', $this->fileName)->update([
                        'room_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }

            $imgPhotoOld = $request['oldImg'];
            $imgPhoto = Photo::where('room_id', $id)->pluck('photo_path')->toArray();
            $array = array_diff($imgPhoto, $imgPhotoOld);
            foreach ($array as $img) {
                File::delete($this->path . '/' . $img);
            }
            Photo::where('room_id', $id)->whereNotIn('photo_path', $request['oldImg'])->forceDelete();
        }

        //UPLOAD FOTO
        if ($request->file('img')) {
            foreach ($request->file('img') as $file) {
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                if ($file->move($this->path, $this->fileName)) {
                    Photo::create([
                        'room_id' => $id,
                        'photo_path' => $this->fileName
                    ]);
                }
            }
        }

        //UPDATE DATA
        Type::where('id', $id)->update(['room_slug' => null]);
        $slug = $this->createSlug(($request['room_name']));

        if (isset($request['room_publish_status'])) {
            $this->room_publish_status = '1';
        } else {
            $this->room_publish_status = '0';
        }

        Type::where('id', $id)->update([
            'room_name' => $request['room_name'],
            'room_slug' => $slug,
            'room_desc' => $request['room_desc'],
            'room_allotment' => $request['room_allotment'],
            'room_publish_rate' => $request['room_publish_rate'],
            'room_ro_rate' => $request['room_ro_rate'],
            'room_weekend_rate' => $request['room_weekend_rate'],
            'room_weekend_ro_rate' => $request['room_weekend_ro_rate'],
            'room_extrabed_rate' => $request['room_extrabed_rate'],
            'room_future_availability' => $request['room_future_availability'],
            'room_order' => $request['room_order'],
            'room_publish_status' =>  $this->room_publish_status
        ]);

    }

    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        if(Rsvp::where('room_id', $id)->exists()){
            return redirect()->back()->with('warning', 'Room cannot be delete because it has reservation');
        }

        $temp_photo = Photo::where('room_id', $id)->get();
        Photo::where('room_id', $id)->forceDelete();
        RoomAmenities::where('room_id', $id)->forceDelete();
        Type::where('id', $id)->forceDelete();
        Bed::where('room_id', $id)->forceDelete();

        foreach ($temp_photo as $img) {
            File::delete($this->path . '/' . $img->photo_path);
        }

        return redirect()->route('room.index')->with('status', 'Data Room Berhasil Dihapus');
    }

    //SET DATA
    public function setData($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    //CREATE SLUG
    public function createSlug($title)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug);
        if (! $allSlugs->contains('room_slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('room_slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug)
    {
        return Type::select('room_slug')->where('room_slug', 'like', $slug.'%')->get();
    }

}
