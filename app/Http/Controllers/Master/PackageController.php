<?php

namespace App\Http\Controllers\Master;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product\Product;
use App\Models\Product\Photos;
use App\Models\Product\Rsvp;
use App\Models\Inquiry\Inquiry;
use App\Models\Setting\PageSetting;

use Carbon\Carbon;
use Image;
use File;

class PackageController extends Controller
{
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = $this->setting();
        $packages = Product::orderBy('category')->orderBy('product_name','ASC')->with('photos')->get();

        //menu code
        $menu = $this->menu();

        if(count($packages) > 0){
            return view('master_data.package.indexisi', ['products'=>$packages, 'setting'=>$setting, 'menu'=>$menu]);
        }else{
            return view('master_data.package.index', get_defined_vars());
        }
    }

    public function create()
    {
        $setting = $this->setting();
        //menu code
        $menu = $this->menu();
        $recreations = PageSetting::where('page_code', 'Recreation')->with('photo')->get();
        $spas = PageSetting::where('page_code', 'Spa')->with('photo')->get();
        $mices = PageSetting::where('page_code', 'Mice')->with('photo')->get();
        $weddings = PageSetting::where('page_code', 'Wedding')->with('photo')->get();

        return view('master_data.package.create', get_defined_vars());
    }

    public function insert(Request $request)
    {
        if($request['id'] != ""){
            $this->validate($request, [
                'product_name' => 'required',
                'product_detail' => 'required',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048',
                'img' => 'required_without:oldImg'
            ],
            [
                'img.required_without' => 'Product photos cannot be empty.',
                'img.*.mimes' => 'Your image format is not supported.',
                'img.*.max' => 'Your image size cannot more than 2mb.'
            ]);

            if ($request->has('product_price') != "") {
                $this->validate($request, [
                    'product_price' => 'not_in:0'
                ],
                [
                    'product_price.not_in' => 'The Package/Product Price Cannot be 0.',
                ]);
            }
            $this->update($request);
        } else {
            $this->validate($request, [
                'product_name' => 'required',
                'product_detail' => 'required',
                'img' => 'required',
                'img.*' => 'mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'img.*.mimes' => 'Your image format is not supported.',
                'img.required' => 'Package photos cannot be empty.',
                'img.*.max' => 'Your image size cannot more than 2mb.'
            ]);

            if ($request->has('product_price') != "") {
                $this->validate($request, [
                    'product_price' => 'not_in:0'
                ],
                [
                    'product_price.not_in' => 'The Package/Product Price Cannot be 0.',
                ]);
            }

            //CREATE ID
            $bytes = openssl_random_pseudo_bytes(4, $cstrong);
            $hex = bin2hex($bytes);
            $id = $hex;
            while (Product::where('id', $id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $id = $hex;
            }

            $slug = $this->createSlug(($request['product_name']));

            Product::create([
                'id'          =>  $id,
                'product_name' => $request['product_name'],
                'product_slug' => $slug,
                'product_detail' => $request['product_detail'],
                'product_price' => $request['product_price'],
                'sales_inquiry' => $request['salesStatus'],
                'category' => $request['selectedCategory']
            ]);


            //UPLOAD FOTO
            if($request->file('img')){
                $data = array();
                $temp = array();
                foreach ($request->file('img') as $file) {
                    //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                    if($file->move($this->path, $this->fileName)){
                        Photos::create([
                            'product_id' => $id,
                            'product_photo_path' => $this->fileName
                        ]);
                    }
                }
            }

            return redirect()->route('package.index')->with('status', 'Product Baru Berhasil di Tambahkan');
        }
            return redirect()->route('package.index')->with('status', 'Product Berhasil di Update');
    }

    //UPDATE DATA
    public function edit($id)
    {
        $setting = $this->setting();
        $id = Crypt::decryptString($id);
        $product = Product::where('id', $id)->with('photos')->first();

        //menu code
        $menu = $this->menu();
        $recreations = PageSetting::where('page_code', 'Recreation')->with('photo')->get();
        $spas = PageSetting::where('page_code', 'Spa')->with('photo')->get();
        $mices = PageSetting::where('page_code', 'Mice')->with('photo')->get();
        $weddings = PageSetting::where('page_code', 'Wedding')->with('photo')->get();

        return view('master_data.package.create', get_defined_vars());
    }

    public function update($request)
    {
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        $temp_photo = Photos::where('product_id', $id)->get();
        Photos::where('product_id', $id)->forceDelete();

        if($request['oldImg']){
            foreach($temp_photo as $img){
            $check = FALSE;
            foreach($request['oldImg'] as $oldImg){
                if($oldImg == $img->product_photo_path){
                $check = TRUE;
                break;
                }
            }
            if(!$check){
                if(file_exists($this->path.'/'.$img->product_photo_path)){
                File::delete($this->path . '/'.$img->product_photo_path);
                }
            }
            }
        }

        if($request['oldImg']){
            $data = array();
            $temp = array();
            $no = 0;
            foreach($request['oldImg'] as $img){
                if($img == "new"){
                    $file = $request->file('img')[$no];
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($this->path, $this->fileName);
                    $no++;
                }else{
                    $this->fileName = $img;
                }

                $temp = array('product_id' => $id, 'product_photo_path' => $this->fileName);
                array_push($data, $temp);
            }
            Photos::insert($data);
        }

        //UPDATE DATA
        Product::where('id', $id)->update(['product_slug' => null]);
        $slug = $this->createSlug(($request['product_name']));

        if (isset($request['product_publish_status'])) {
            $this->product_publish_status = '1';
        } else {
            $this->product_publish_status = '0';
        }

        Product::where('id', $id)->update([
            'product_name' => $request['product_name'],
            'product_slug' => $slug,
            'product_detail' => $request['product_detail'],
            'product_price' => $request['product_price'],
            'sales_inquiry' => $request['salesStatus'],
            'category' => $request['selectedCategory'],
            'product_publish_status' =>  $this->product_publish_status
        ]);
    }


    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);

        if(Rsvp::where('product_id', $id)->exists()){
            return response()->json(["status" => 422, "msg"=> 'Product cannot be delete because it has reservation']);
        }

        if(Inquiry::where('product_id', $id)->exists()){
            return response()->json(["status" => 422, "msg"=> 'Product cannot be delete because it has inquiry']);
        }

        $temp_photo = Photos::where('product_id', $id)->get();
        Photos::where('product_id', $id)->forceDelete();
        Product::where('id', $id)->forceDelete();

        foreach($temp_photo as $img){
            File::delete($this->path . '/'. $img->product_photo_path);
        }

        return redirect()->route('package.index')->with('status', 'Data Package Berhasil Dihapus');
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
        if (! $allSlugs->contains('product_slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('product_slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug)
    {
        return Product::select('product_slug')->where('product_slug', 'like', $slug.'%')->get();
    }
}
