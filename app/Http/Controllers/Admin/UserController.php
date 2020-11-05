<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Admin\User;
// use App\Models\Admin\LogActivity;

use Carbon\Carbon;
use Image;
use File;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = base_path() . '/public/user';
    }

    public function index()
    {
        $setting = $this->setting();
        $users = User::orderBy('username')->get();
        $deleted = User::onlyTrashed()->get();

        return view('main_page.account.index', get_defined_vars());
    }

    public function create()
    {
        $setting = $this->setting();
        return view('main_page.account.create', get_defined_vars());
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        //  check for passing to update function
        if($request['id']!= ""){
            $this->validate($request, [
                'name'          => 'required',
                'username'      => 'required|regex:/^\S*$/u|alpha_dash',
                'img' => 'mimes:jpeg,png,jpg|max:2048',
                'phone' => 'required',
                // 'email' => 'unique:users,email'
            ],
            [
                'img.mimes' => 'Your image format is not supported',
                'img.max' => 'The uploaded photos cannot exceed 2MB, try upload smaller size',
                // 'email.unique' => 'Email has already been taken 1'
            ]);

            if ($request->input('password') !== null) {
                $this->validate($request, [
                    'password'      => 'min:6|regex:/^.(?=\D*\d).(?=[^a-z]*[a-z])/',
                    'pw_confirm'    => 'same:password|min:6',
                ],
                [
                    'password.regex' => 'Password must contain a number or a character.',
                    'pw_confirm.same' => 'Verify password and password must match.',
                ]);
            }

            $requestid = $request['id'];
            $id = Crypt::decryptString($requestid);
            $user = User::where('id', $id)->first();

            if($request['username'] != $user->username){
                $checkUsername = User::where('username', $request['username'])->get();
                if(count($checkUsername)>0){
                return back()->with('warning', 'Username is not available, please choose another username');
                }else{
                    $this->update($request);
                }
            }else{
                $this->update($request);
            }
        }else{
            bcrypt($request->password);
            // dd($request->all());
            $this->validate($request, [
            'name'          => 'required',
            'username'      => 'required',
            'phone' => 'required',
            'email' => 'unique:users,email',
            'img' => 'required',
            'img' => 'mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'img.mimes' => 'Your image format is not supported.',
                'img.required' => 'Room photos cannot be empty.',
                'img.max' => 'The uploaded photos cannot exceed 2MB, try upload smaller size.',
                'email.unique' => 'Email has already been taken.'
            ]);

            if ($request->has('password') != "") {
                $this->validate($request, [
                    'password'      => 'required|min:6|regex:/^.(?=\D*\d).(?=[^a-z]*[a-z])/',
                    'pw_confirm'    => 'required_with:password|same:password|min:6',
                ],
                [
                    'password.regex' => 'Password must contain a number or a character.',
                    'pw_confirm.same' => 'Verify password and password must match.',
                ]);
            }

            $checkUsername = User::where('username', $request['username'])->get();
            if(count($checkUsername)>0) {
                return back()->with('warning', 'Username is not avalaible, please choose another username');
            } else {
                //UPLOAD FOTO
                if($request->file('img')){
                    $file = $request->file('img');
                    //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                    $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                    $file->move($this->path,$this->fileName);
                }else{
                    $this->fileName = '';
                }

                User::create([
                    'username'      => $request['username'],
                    'name'          => $request['name'],
                    'phone'          => $request['phone'],
                    'email'          => $request['email'],
                    'password'      => bcrypt ($request['password']),
                    'level'          => $request['level'],
                    'img'            => $this->fileName
                ]);

                return redirect()->route('account.index')->with('status', 'User Baru Berhasil di Tambahkan');
            }
        }
        if ($request['from'] == "account") {
            return redirect()->route('account.index')->with('status', 'Update Data Berhasil');
        }else if($request['from'] == "profile"){
            return redirect()->back()->with('status', 'Update Data Berhasil');
        }
    }

    //UPDATE DATA
    public function edit($id, $myAccount)
    {
        $setting = $this->setting();
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return view('main_page.account.create', get_defined_vars());
    }

    public function update($request)
    {
        // dd($request);
        $requestid = $request['id'];
        $id = Crypt::decryptString($requestid);
        $user = User::where('id', $id)->first();

        // $this->validate($request, [
        //     'email' => 'unique:users,email',
        // ],
        // [
        //     'email.unique' => 'Email has already been taken 3'
        // ]);

        //UPLOAD FOTO
        if($request->file('img')){

        File::delete($this->path . '/'. $user->img);
        $file = $request->file('img');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $this->fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        $file->move($this->path,$this->fileName);
            User::where('id', $id)->update([
                'img'            => $this->fileName
            ]);
        }

        //CHANGE PASSWORD
        if($request['password']){
            bcrypt($request['password-two']);
            $this->validate($request, [
                'password' => 'required', 'min:6'
            ]);
            User::where('id', $id)->update([
                'password'      => bcrypt ($request['password'])
            ]);
        }

        //UPDATE DATA
        User::where('id', $id)->update([
            'username'      => $request['username'],
            'name'          => $request['name'],
            'phone'          => $request['phone'],
            'email'          => $request['email'],
            'level'          => $request['level']
        ]);

        return redirect()->route('account.index')->with('status', 'Update Data Berhasil');
    }

    //DELETE DATA
    public function delete($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::find($id);
        $user->delete();

        return redirect()->route('account.index')->with('status', 'Data User Berhasil Dihapus');
    }

    public function restore($id)
    {
        $id = Crypt::decryptString($id);
        // hapus file
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();
        return redirect()->route('account.index')->with('status', 'Data User Berhasil Direstore');
    }

    //SET DATA
    public function setData($id){
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }
}
