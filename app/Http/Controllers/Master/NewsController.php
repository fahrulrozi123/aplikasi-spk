<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Visitor\News;
use Auth;
use Carbon\Carbon;
// use App\Models\Admin\LogActivity;

use File;
use Illuminate\Support\Facades\Crypt;


//validator

use Illuminate\Http\Request;
use Validator,Redirect,Response;

class NewsController extends Controller
{

    public function __construct()
    {

        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = $this->setting();
        $newss = News::orderBy('news_sticky_state', 'DESC')->orderBy('news_publish_status','DESC')->orderBy('news_publish_date', 'DESC')->paginate(11);
        foreach ($newss as $key => $value) {
            $value->news_publish_date = Carbon::parse($value->news_publish_date)->format('d F Y');
        }

        if (count($newss) > 0) {
            return view('master_data.news.index', get_defined_vars());
        } else {
            return view('master_data.news.empty', get_defined_vars());
        }
    }

    public function create()
    {
        $setting = $this->setting();
        return view('master_data.news.create', get_defined_vars());
    }

    public function insert(Request $request)
    {
        // dd($request);
        if (isset($request['news_pin_state'])) {
            $this->news_sticky_state = '1';
            if (News::where('news_sticky_state', "1")->exists()) {
                News::where('news_sticky_state', "1")->update([
                    'news_sticky_state' => "0"
                ]);
            }
        } else {
            $this->news_sticky_state = '0';
        }

        if (isset($request['news_hide_state'])) {
            $this->news_publish_status = '0';
        } else {
            $this->news_publish_status = '1';
        }

        if ($request['id'] != "") {
            $this->validate($request, [
                'news_title' => 'required',
                'news_content' => 'required',
                'news_publish_date' => 'required',
                'img' => 'mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'img.mimes' => 'Your image format is not supported',
                'img.max' => 'Your image size cannot more than 2mb'
            ]);

            $id = Crypt::decryptString($request['id']);
            $data = News::where('id', $id)->first();

            //UPLOAD FOTO
            if ($request->file('img')) {
                $file = $request->file('img');
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                $file->move($this->path, $this->fileName);
                File::delete($this->path . '/' . $data->news_photo_path);
            } else {
                $this->fileName = $data->news_photo_path;
            }

            $publish_date = Carbon::parse($request['news_publish_date'])->format('Y-m-d');
            News::where('id', $id)->update([
                'user_id' => Auth::id(),
                'news_title' => $request['news_title'],
                'news_content' => $request['news_content'],
                'news_photo_path' => $this->fileName,
                'news_sticky_state' => $this->news_sticky_state,
                'news_publish_status' => $this->news_publish_status,
                'news_publish_date' => $publish_date,
            ]);

            return redirect()->route('news.index')->with('status', 'News Berhasil di Update');
        } else {
            $this->validate($request, [
                'news_title' => 'required',
                'news_content' => 'required',
                'news_publish_date' => 'required',
                'img' => 'required|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'img.max' => 'Your image size cannot more than 2mb.',
                'img.mimes' => 'Your image format is not supported.',
                'img.required' => 'News photos cannot be empty.'
            ]);

            //UPLOAD FOTO
            if ($request->file('img')) {
                $file = $request->file('img');
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                $file->move($this->path, $this->fileName);
            } else {
                $this->fileName = '0';
            }

            //CREATE ID
            $bytes = openssl_random_pseudo_bytes(4, $cstrong);
            $hex = bin2hex($bytes);
            $id = $hex;
            while (News::where('id', $id)->exists()) {
                $bytes = openssl_random_pseudo_bytes(4, $cstrong);
                $hex = bin2hex($bytes);
                $id = $hex;
            }

            $publish_date = Carbon::parse($request['news_publish_date'])->format('Y-m-d');

            News::create([
                'id'    => $id,
                'user_id' => Auth::id(),
                'news_title' => $request['news_title'],
                'news_content' => $request['news_content'],
                'news_photo_path' => $this->fileName,
                'news_sticky_state' => $this->news_sticky_state,
                'news_publish_status' => $this->news_publish_status,
                'news_publish_date' => $publish_date,
            ]);

            return redirect()->route('news.index')->with('status', 'News Baru Berhasil di Tambahkan');
        }

        //LOGACTIVITY
        // $logmessage = Auth::User()->username . " Membuat User Baru : " . $request['username'];
        // $log = LogActivity::create([
        //   'created_at' => Carbon::now(),
        //   'modul' => 'Admin',
        //   'log' => $logmessage ]);
        //LOGACTIVITY
    }

    //UPDATE DATA
    public function edit($id)
    {
        $setting = $this->setting();
        $id = Crypt::decryptString($id);
        $news = News::where('id', $id)->first();
        return view('master_data.news.create', get_defined_vars());
    }

    public function update(Request $request)
    {
        // dd($request);
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
        // dd($data);

        //LOGACTIVITY
        // $logmessage = Auth::User()->username . " Mengupdate Data User : " . $request['username'];
        // $log = LogActivity::create([
        //   'created_at' => Carbon::now(),
        //   'modul' => 'Admin',
        //   'log' => $logmessage ]);
        //LOGACTIVITY

        return redirect()->route('account.index')->with('status', 'Update Data Berhasil');
    }

    //DELETE DATA
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request['id']);
        // hapus file
        $data = News::where('id', $id)->first();
        if ($unit = News::findOrFail($id)->forceDelete()) {
            File::delete($this->path . '/' . $data->news_photo_path);
            return redirect()->route('news.index')->with('status', 'News Berhasil Dihapus');
        } else {
            return redirect()->route('news.index')->with('warning', 'News Gagal Dihapus');
        }
        //hapus data

        //LOGACTIVITY
        // $logmessage = Auth::User()->username . " Menghapus Data User : " . $userdata['username'];
        // $log = LogActivity::create([
        //   'created_at' => Carbon::now(),
        //   'modul' => 'Admin',
        //   'log' => $logmessage ]);
        //LOGACTIVITY
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            // if($file->getSize() > 2046000){
            //     $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            //     $msg = 'Photo size is too big!';
            //     $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$msg')</script>";
            //                 // Render HTML output
            //     @header('Content-type: text/html; charset=utf-8');
            //     echo $re;
            //     return 0;
            // }
            $validator = Validator::make($request->all(), [
                'upload' => 'mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'upload.mimes' => 'Your image format is not supported',
                'upload.max' => 'Your image size cannot more than 2mb'
            ]);

            if ($validator->fails()) {
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $msg = $validator->messages()->first();
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$msg')</script>";
                            // Render HTML output
                @header('Content-type: text/html; charset=utf-8');
                echo $re;
                return 0;
            }
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

           //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    //SET DATA
    public function setData($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

}
