<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Notifications\PushDemo;
use Notification;


class TestingController extends Controller
{
    public function storeNotification(Request $request)
    {
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $id = Session::get('room_booking_id');
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];

        RoomRsvp::where('booking_id', $id)->update([
            'endpoint' => $endpoint,
            'public_key' => $key,
            'auth_token' => $token,
        ]);

        $this->push($id);
    }

    public function push(){

        $data = RoomRsvp::where('booking_id', "1c8488b3d796b20e")->limit(1)->get();

        Notification::send($data, new PushDemo);

        return response()->json(['success' => true],200);
    }

    public function test_email()
    {
        $this->resendEmail("ROOMS", "75601RSVRM1VII2020");
    }

    public function test_email2()
    {
        $this->resendEmail("INQUIRY", "09162INQPDGEN1VIII2020");
    }
}
