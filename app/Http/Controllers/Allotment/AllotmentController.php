<?php

namespace App\Http\Controllers\Allotment;

use App\Http\Controllers\Controller;
use App\Models\Allotment\Allotment;
use App\Models\Room\Type;
use Auth;
use Carbon\Carbon;

use DateTime;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;

class AllotmentController extends Controller
{

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = $this->setting();
        $rooms = Type::orderBy('room_name')->with('photo')->get();
        if (count($rooms) > 0) {
            return view('main_page.allotment.index', ['rooms' => $rooms, 'setting' => $setting]);
        } else {
            return view('main_page.allotment.index');
        }
    }

    public function data()
    {
        $rooms = Type::orderBy('room_name')->with('photo')->get();
        foreach ($rooms as $key => $value) {
            $value['allotment'] = [];
            $query = "SELECT allotment.*,
            (allotment.allotment_room - (SELECT Ifnull(SUM(rsvp_total_room), 0) FROM room_rsvp
            WHERE room_id = '".$value['id']."' AND rsvp_date_reserve = allotment.allotment_date
            AND rsvp_status IN ('Payment received', 'Waiting for payment') )) AS remaining_allotment
            FROM allotment where room_id = '".$value['id']."' and allotment_date >= CURDATE() ORDER BY allotment.allotment_date";
            $allotment = DB::select(DB::raw($query));
            $value['allotment'] = $allotment;
        }
        return $rooms;
    }

    public function report_data()
    {
        $start_date = Input::get('start_date', null);
        $end_date = Input::get('end_date', null);

        $rooms = Type::orderBy('room_name')->with('photo')->get();
        foreach ($rooms as $key => $value) {
            $value['allotment'] = [];
            $query = "SELECT allotment.*,
            (allotment.allotment_room - (SELECT Ifnull(SUM(rsvp_total_room), 0) FROM room_rsvp
                WHERE room_id = '".$value['id']."' AND rsvp_date_reserve = allotment.allotment_date
                    AND rsvp_status IN ('Payment received', 'Waiting for payment') )) AS remaining_allotment
                        FROM allotment where room_id = '".$value['id']."'
                            and allotment.allotment_date BETWEEN '".$start_date."'
                                and '".$end_date."' ORDER BY allotment.allotment_date";

            $allotment = DB::select(DB::raw($query));
            $value['allotment'] = $allotment;
        }
        return $rooms;
    }

    public function this_month_data()
    {
        $firstDay = Carbon::now()->firstOfMonth();
        $lastDay = Carbon::now()->lastOfMonth();
        $allotments = Allotment::select('room_type.room_name', 'allotment.allotment_room', 'room_type.room_allotment')
            ->where('allotment_date', '>=', $firstDay)
            ->where('allotment_date', '<=', $lastDay)
            ->join('room_type', 'room_type.id', '=', 'allotment.room_id')
            ->orderBy('allotment.allotment_date')->get();
        return $allotments;
    }

    public function create()
    {
        return view('main_page.account.create');
    }

    public function insert(Request $request)
    {
        $data = array();
        $temp = array();
        $dateStart = $request['dateStart'];
        $dateEnd = $request['dateEnd'];
        $datetime1 = new DateTime($dateStart);
        $datetime2 = new DateTime($dateEnd);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $requestid = $request['room_id'];
        $room_id = $requestid;
        $create_at = Carbon::now();

        if ($dateStart == $dateEnd) {
            $temp = array('room_id' => $room_id,
                'user_id' => Auth::id(),
                'allotment_room' => $request['room_allotment'],
                'allotment_publish_rate' => $request['room_publish_rate'],
                'allotment_ro_rate' => $request['room_ro_rate'],
                'allotment_extrabed_rate' => $request['room_extrabed_rate'],
                'allotment_date' => $dateStart,
                'create_at' => $create_at);
            array_push($data, $temp);

        } else {
            for ($i = 0; $i <= $days; $i++) {
                $newDate = Carbon::parse($dateStart)->addDays($i);
                // $newformat = date('Y-m-d', $newDate);
                $temp = array('room_id' => $room_id,
                    'user_id' => Auth::id(),
                    'allotment_room' => $request['room_allotment'],
                    'allotment_publish_rate' => $request['room_publish_rate'],
                    'allotment_ro_rate' => $request['room_ro_rate'],
                    'allotment_extrabed_rate' => $request['room_extrabed_rate'],
                    'allotment_date' => $newDate,
                    'create_at' => $create_at);
                array_push($data, $temp);
            }
        }

        if ($request['room_id'] != "") {
            if ($dateStart == $dateEnd) {
                $results = Allotment::where('room_id', $request['room_id'])
                    ->where('allotment_date', $dateStart)
                    ->get();
                if (count($results) > 0) {
                        foreach ($data as $key => $value) {
                            Allotment::where('room_id', $value['room_id'])
                            ->where('allotment_date', $value['allotment_date'])
                            ->update($value);
                        }
                } else {
                    Allotment::insert($data);
                }
            } else {
                foreach ($data as $key => $row) {
                    $results = Allotment::where('room_id', $row['room_id'])
                        ->where('allotment_date', $row['allotment_date'])
                        ->get();
                    if (count($results) > 0) {
                        Allotment::where('room_id', $row['room_id'])
                            ->where('allotment_date', $row['allotment_date'])
                            ->update($row);
                    } else {
                        Allotment::insert($row);
                    }
                }
            }

        } else {
            Allotment::insert($data);
            // return redirect()->route('allotment.index')->with('status', 'Allotment Baru Berhasil di Tambahkan');
        }
        // return redirect()->route('allotment.index')->with('status', 'Allotment Baru Berhasil di Tambahkan');
    }

    //UPDATE DATA
    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();

        return view('main_page.account.create', get_defined_vars());
    }

    public function update($request)
    {
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        $user = User::where('id', $id)->first();

        //UPLOAD FOTO
        if ($request->file('img')) {

            File::delete($this->path . '/' . $user->img);
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
            'level' => $request['level'],
        ]);

        return redirect()->route('account.index')->with('status', 'Update Data Berhasil');
    }

    //DELETE DATA
    public function delete($id)
    {
        $id = Crypt::decryptString($id);
        // hapus file
        $userdata = User::where('id', $id)->first();
        File::delete($this->path . '/' . $userdata->img);
        //hapus data
        $unit = User::findOrFail($id)->forceDelete();

        return redirect()->route('account.index')->with('status', 'Data User Berhasil Dihapus !');
    }

    //SET DATA
    public function setData($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

}
