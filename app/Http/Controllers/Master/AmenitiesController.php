<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Amenities\Amenities;
use App\Models\Room\RoomAmenities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AmenitiesController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        // $this->path = storage_path('app/public/user');
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

        $amenitiess = Amenities::orderBy('id')->get();
        return view('master_data.amenities.indexisi', get_defined_vars());
    }

    public function create()
    {
        $amenitiess = Amenities::orderBy('id')->get();
        if (isset($amenitiess)) {
            return view('master_data.amenities.create', ['amenitiess' => $amenitiess]);
        } else {
            return view('master_data.amenities.create');
        }
    }

    public function insert(Request $request)
    {
        if (isset($request['amenities_status'])) {
            $amenities_id = $request['amenities_id'];
            $amenities_name = $request['amenities_name'];
            $amenities_icon = $request['amenities_icon'];

            $amenitiess = Amenities::orderBy('id')->get();

            foreach ($amenitiess as $amenities) {
                $check = false;
                $old_id = $amenities->id;
                foreach ($amenities_id as $new_id) {
                    if ($old_id == $new_id) {
                        $check = true;
                        break;
                    }
                }
                if (!$check) {
                    Amenities::where('id', $old_id)->forceDelete();
                    RoomAmenities::where('amenities_id', $old_id)->forceDelete();
                }
            }

            foreach ($request['amenities_status'] as $key => $value) {
                if ($value == "3") {
                    Amenities::create([
                        'amenities_name' => $amenities_name[$key],
                        'amenities_icon' => $amenities_icon[$key]
                    ]);
                } elseif ($value == "1") {
                    Amenities::where('id', $amenities_id[$key])->update([
                        'amenities_name' => $amenities_name[$key],
                        'amenities_icon' => $amenities_icon[$key]
                    ]);
                }
            }

        } else {
            Amenities::truncate();
        }
        return redirect()->route('amenities.index')->with('status', 'Amenities Berhasil di Update');
    }

    //UPDATE DATA
    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $rooms = Type::where('id', $id)->first();
        return view('master_data.room.insert', get_defined_vars());
    }

    public function update(Request $request)
    {
        $requestid = $request['id_user'];
        $id = Crypt::decryptString($requestid);
        //UPLOAD FOTO
        if ($request->file('img')) {
            $file = $request->file('img');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            $file->move($this->path, $this->fileName);
            User::where('id', $id)->update([
                'img' => $this->fileName,
            ]);
        }

        //CHANGE PASSWORD
        if ($request['password']) {
            bcrypt($request['password']);
            $this->validate($request, [
                'password' => 'min:6',
            ]);
            User::where('id', $id)->update([
                'password' => bcrypt($request['password']),
            ]);
        }

        //UPDATE DATA
        User::where('id', $id)->update([
            'username' => $request['username'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'level' => $request['level'],
            'img' => $this->fileName,
        ]);

        return redirect()->route('account.index')->with('status', 'Update Data Berhasil');
    }

    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        // hapus file
        $data = Amenities::where('id', $id)->first();
        if ($unit = Banner::findOrFail($id)->forceDelete()) {
            return redirect()->route('banner.index')->with('status', 'Banner Berhasil Dihapus');
        } else {
            return redirect()->route('banner.index')->with('warning', 'Banner Gagal Dihapus');
        }
    }

    public function setData($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

}
