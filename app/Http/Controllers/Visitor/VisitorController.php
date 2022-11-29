<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use PDF;
use Illuminate\Support\Facades\Validator;

use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;
use App\Models\Visitor\Banner;
use App\Models\Visitor\News;
use App\Models\Room\Type;
use App\Models\Product\Product;
use App\Models\FunctionRoom\FunctionRoom;

class VisitorController extends Controller
{
    public function index()
    {
        // $banners = Banner::orderBy('banner_status', 'ASC')->get();
        // $newss = News::where('news_publish_date', '<=', Carbon::now())->where('news_publish_status', "1")->orderBy('news_sticky_state', 'DESC')->orderBy('news_publish_date', 'DESC')->get();
        // foreach ($newss as $key => $value) {
        //     $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        // }

        // // index
        // $spas = PageSetting::where('page_code', 'Spa')->with('photo')->get();
        // $functionrooms = PageSetting::where('page_code', 'Function')->with('photo')->get();
        // $mices = PageSetting::where('page_code', 'Mice')->with('photo')->get();
        // $recreations = PageSetting::where('page_code', 'Recreation')->with('photo')->get();

        // $menu = $this->menu();
        // $setting = $this->setting();

        return view('visitor_site.reservation.index', get_defined_vars());
        // return redirect()->route('visitor.reservation');
    }


    public function reservation()
    {
        $room_available = [];
        $totalDays = Input::get('stay_total', null);
        $totalRoom = Input::get('room_total', null);
        $totalExtrabed = Input::get('extra_bed', null);
        $adultTotal = Input::get('adult_total', null);
        $childTotal = Input::get('child_total', null);
        $childAge = Input::get('child_age', null);
        $checkIn = Carbon::parse(Input::get('checkin', null))->format('Y-m-d');
        $checkOut = Carbon::parse($checkIn)->addDays($totalDays);
        $today = Carbon::now();
        $today = Carbon::parse($today)->format('Y-m-d');

        $totalGuest = $adultTotal + $childTotal;

        if ($checkIn < $today) {
            return redirect()->route('index');
        }
        if ($childTotal > 0) {
            $childTemp = explode(',', $childAge);
            if (count($childTemp) != $childTotal) {
                return redirect()->route('index');
            }
            foreach ($childTemp as $key => $value) {
                if ($value == "" || $value > 10) {
                    return redirect()->route('index');
                } else {
                    $childTemp[$key] = (int) $value;
                }
            }
        } else {
            if ($childAge != null) {
                return redirect()->route('index');
            }
            $childTemp = (array) null;
        }

        if ($checkIn == null || $totalDays == null || $totalRoom == null || $totalExtrabed == null || $adultTotal == null || $childTotal == null) {

            return redirect()->route('index');
        }

        $adult_child_total = $adultTotal + $childTotal;
        $max_adult_child = $totalRoom * 5 + $totalExtrabed;
        $need_extrabed = $totalRoom * 2 + 1;

        //validation adult
        $max_adult = $totalRoom * 2 + $totalRoom;
        $min_adult = $totalRoom;

        //validation child
        $min_child = 0;
        $max_child = $totalRoom * 2;

        //validation Extrabed
        $min_extrabed = floor($adultTotal / ($totalRoom + 1));
        $max_extrabed = $totalRoom;
        $max_child = $totalRoom;

        if ($totalRoom > 5) {

            return redirect()->route('index');
        }
        if ($totalExtrabed > $max_extrabed) {

            return redirect()->route('index');
        }
        if ($adultTotal < $min_adult || $adultTotal > $max_adult) {

            return redirect()->route('index');
        }
        if ($adultTotal == $need_extrabed && $totalExtrabed < $min_extrabed) {

            return redirect()->route('index');
        }
        if ($adult_child_total > $max_adult_child) {

            return redirect()->route('index');
        }

        if ($totalExtrabed == 0) {
            $rooms = Type::where('room_publish_status', 1)->with('bed')->with('allotment')->with('amenities')->with('photo')->orderBy('room_publish_rate', 'ASC')->get();
        } else {
            $rooms = Type::where('room_publish_status', 1)->where('room_extrabed_rate', '<>', 0)->with('bed')->with('allotment')->with('amenities')->with('photo')->orderBy('room_publish_rate', 'ASC')->get();
        }
        foreach ($rooms as $key => $value) {
            $cek = $this->availableDate($checkIn, $totalDays, $totalRoom, $value->id);

            if ($cek) {
                $room = Type::with('bed')->with('amenities')->with('photo')->orderBy('room_publish_rate', 'ASC')->with(['allotment' => function ($q) use ($checkIn) {
                    // Query the name field in status table
                    $q->where('allotment.allotment_date', '=', $checkIn); // '=' is optional
                }])
                    ->where('id', $value->id)
                    ->first();
                array_push($room_available, $room);
            }
        }

        $checkIn  = Carbon::parse($checkIn)->format('d F Y');
        $checkOut = Carbon::parse($checkOut)->format('d F Y');

        $menu     = $this->menu();
        $setting  = $this->setting();
        return view('visitor_site.reservation.index', get_defined_vars());
    }

    public function room_reservation(Request $request)
    {
        $data = $request['reserve_data'];
        $data = json_decode($data);

        if (!isset($data->childAge)) {
            return redirect()->route('index');
        }

        $data->childAge = explode(',', $data->childAge);
        $cek = $this->availableDate($data->checkIn, $data->totalDays, $data->totalRooms, $data->room);

        if (!$cek) {
            return redirect()->route('index');
        }

        if (Session::get('room_booking_id') != null && RoomRsvp::where('reservation_id', 'NULL')->where('booking_id', Session::get('room_booking_id'))->exists()) {
            $booking_id = Session::get('room_booking_id');
            $data = $this->input_rsvp($booking_id, $data);

        } else {
            Session::forget('room_booking_id');
            $data = $this->input_rsvp(false, $data);
            Session::put('room_booking_id', $data->booking_id);
        }
        if (!$data) {
            return redirect()->route('index');
        }

        $setting = $this->setting();

        $paymentChannels = $this->paymentChannel();
        $list = json_decode($paymentChannels, true);
        $listPaymentChannels = $list['payment_channel'];

        return view('visitor_site.reserve.index', get_defined_vars());
    }

    public function rooms()
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $dateNow = Carbon::now()->format('Y-m-d');
        $rooms = Type::where('room_publish_status', 1)->with('allotment_day')->with('amenities')->with('photo')->orderBy('room_order', 'ASC')->get();
        $pagesettings = PageSetting::where('page_code', 'Room')->with('photo')->get();

        return view('visitor_site.rooms.index', get_defined_vars());
    }

    public function roomDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();

        $photos = array();

        if (!Type::where('room_slug', $slug)->where('room_publish_status', 1)->exists()) {
            return abort(404);
        }

        $room = Type::where('room_slug', $slug)->with('photo')->first();

        $data = (object) array(
            "name" => $room->room_name,
            "title" => ucwords(strtolower($room->room_name)),
            "detail" => $room->room_desc
        );

        foreach ($room['photo'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.rooms.details', get_defined_vars());
    }

    public function recreation()
    {
        $menu = $this->menu();
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $recreations = Product::where('product_publish_status', 1)->where('category', '1')->orderBy('id', 'DESC')->with('photos')->get();
        $pagesettings = PageSetting::where('page_code', 'Recreation')->with('photo')->get();

        return view('visitor_site.recreation.index', get_defined_vars());
    }

    public function recreationDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!Product::where('product_slug', $slug)->where('product_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $product = Product::where('product_slug', $slug)->with('photos')->first();

        $data = (object) array(
            "name" => $product->product_name,
            "title" => ucwords(strtolower($product->product_name)),
            "detail" => $product->product_detail
        );

        foreach ($product['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->product_photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.recreation.details', get_defined_vars());
    }

    public function allysea_spa()
    {
        $menu = $this->menu();
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $spas = Product::where('product_publish_status', 1)->where('category', '2')->orderBy('id', 'DESC')->with('photos')->get();
        $pagesettings = PageSetting::where('page_code', 'Spa')->with('photo')->get();

        return view('visitor_site.allysea_spa.index', get_defined_vars());

    }

    public function allyseaSpaDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!Product::where('product_slug', $slug)->where('product_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $product = Product::where('product_slug', $slug)->with('photos')->first();

        $data = (object) array(
            "name" => $product->product_name,
            "title" => ucwords(strtolower($product->product_name)),
            "detail" => $product->product_detail
        );

        foreach ($product['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->product_photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.allysea_spa.details', get_defined_vars());
    }

    public function mice()
    {
        $menu = $this->menu();
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $mices = Product::where('product_publish_status', 1)->where('category', '3')->orderBy('category')->orderBy('id', 'DESC')->with('photos')->get();
        $pagesettings = PageSetting::where('page_code', 'Mice')->with('photo')->get();

        return view('visitor_site.mice.index', get_defined_vars());
    }

    public function miceDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!Product::where('product_slug', $slug)->where('product_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $product = Product::where('product_slug', $slug)->with('photos')->first();

        $data = (object) array(
            "name" => $product->product_name,
            "title" => ucwords(strtolower($product->product_name)),
            "detail" => $product->product_detail
        );

        foreach ($product['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->product_photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.mice.details', get_defined_vars());
    }

    public function wedding()
    {
        $menu = $this->menu();
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $mices = Product::where('product_publish_status', 1)->where('category', '4')->orderBy('category')->orderBy('id', 'DESC')->with('photos')->get();
        $pagesettings = PageSetting::where('page_code', 'Wedding')->with('photo')->get();

        return view('visitor_site.wedding.index', get_defined_vars());
    }

    public function weddingDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!Product::where('product_slug', $slug)->where('product_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $product = Product::where('product_slug', $slug)->with('photos')->first();

        $data = (object) array(
            "name" => $product->product_name,
            "title" => ucwords(strtolower($product->product_name)),
            "detail" => $product->product_detail
        );

        foreach ($product['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->product_photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.allysea_spa.details', get_defined_vars());
    }

    public function function_room()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $today = Carbon::parse(Carbon::now())->isoFormat("DD MMMM YYYY");
        $function_rooms = FunctionRoom::where('func_publish_status', 1)->with('partition')->with('photos')->where('func_head', null)
                        ->orderBy('func_name')->get();
        $mices = Product::where('product_publish_status', 1)->where('category', '3')->orWhere('category', '4')->orderBy('category')
                ->orderBy('category', 'DESC')->with('photos')->get();
        $pagesettings = PageSetting::where('page_code', 'Function')->with('photo')->get();
        return view('visitor_site.function_room.index', get_defined_vars());
    }

    public function functiomRoomDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!FunctionRoom::where('func_room_slug', $slug)->where('func_publish_status', 1)->with('photos')->where('func_head', null)->exists()) {
            return abort(404);
        }

        $function = FunctionRoom::where('func_room_slug', $slug)->with('partition')->with('photos')->where('func_head', null)->first();

        $data = (object) array(
            "name" => $function->func_name,
            "title" => ucwords(strtolower($function->func_name)),
            "detail" => $function->func_room_desc,
            "function" => $function);

        foreach ($function['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.function_room.details', get_defined_vars());
    }

    public function functiomRoomMiceWeddingDetail($slug)
    {
        $arrContextOptions = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $photos = array();

        if (!Product::where('product_slug', $slug)->where('product_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $product = Product::where('product_slug', $slug)->with('photos')->first();

        $data = (object) array(
            "name" => $product->product_name,
            "title" => ucwords(strtolower($product->product_name)),
            "detail" => $product->product_detail
        );

        foreach ($product['photos'] as $key => $value) {
            $temp = (object) array(
                'photo_path' => $value->product_photo_path,
            );
            array_push($photos, $temp);
        }

        return view('visitor_site.mice.details', get_defined_vars());
    }

    public function newsletter()
    {
        $menu = $this->menu();
        $setting = $this->setting();
        $newss = News::where('news_publish_date', '<=', Carbon::now())->where('news_publish_status', "1")->orderBy('news_sticky_state', 'DESC')->orderBy('news_publish_date', 'DESC')->paginate(8);
        foreach ($newss as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }
        $pagesettings = PageSetting::where('page_code', 'Newsletter')->with('photo')->get();

        return view('visitor_site.newsletter.index', get_defined_vars());

    }

    public function news_detail($slug)
    {
        $menu = $this->menu();
        $setting = $this->setting();

        if (!News::where('news_slug', $slug)->where('news_publish_status', 1)->with('photos')->exists()) {
            return abort(404);
        }

        $news = News::where('news_slug', $slug)->first();
        $news->news_publish_date = Carbon::parse($news->news_publish_date)->format('l d F Y');
        $other_news = News::where('news_slug', '<>', $slug)->orderBy("news_sticky_state", "DESC")->orderBy("news_publish_date", "DESC")->get();
        foreach ($other_news as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }
        return view('visitor_site.newsletter.details', get_defined_vars());
    }

    public function details()
    {
        $arrContextOptions =array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $menu = $this->menu();
        $setting = $this->setting();
        $id = Input::get('key', null);
        $from = Input::get('from', null);

        $photos = array();

        if ($from == "rooms") {
            $room = Type::where('id', $id)->first();

            if($room == NULL) {
                return abort(404);
            } else {
                return redirect(route('room.slug', $room->room_slug), 301);
            }
        } else if ($from == "recreation") {
            $product = Product::where('id', $id)->first();

            if($product == NULL) {
                return abort(404);
            } else {
                return redirect(route('recreation.slug', $product->product_slug), 301);
            }
        } else if ($from == "allysea_spa") {
            $spa = Product::where('id', $id)->first();

            if($spa == NULL) {
                return abort(404);
            } else {
                return redirect(route('allysea_spa.slug', $spa->product_slug), 301);
            }
        } else if ($from == "mice_wedding") {
            $miceWedding = Product::where('id', $id)->first();

            if($miceWedding == NULL) {
                return abort(404);
            } else {
                return redirect(route('mice_wedding.slug', $miceWedding->product_slug), 301);
            }
        } else if ($from == "function_roomA") {
            $functionroom = FunctionRoom::where('id', $id)->first();

            if($functionroom == NULL) {
                return abort(404);
            } else {
                return redirect(route('functionroom.slug', $functionroom->func_room_slug), 301);
            }
        } else if ($from == "function_roomB") {
            $miceWedding = Product::where('id', $id)->first();

            if($miceWedding == NULL) {
                return abort(404);
            } else {
                return redirect(route('micewedding.slug', $miceWedding->product_slug), 301);
            }
        }

    }
}
