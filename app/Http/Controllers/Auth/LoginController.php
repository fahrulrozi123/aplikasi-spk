<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin\User;
use App\Models\Setting\Setting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // data profile setting
    public function setting()
    {
        return Setting::first();
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin_site';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/enter_site');
    }

    public function username() {
        return 'username';
    }

    function authenticated(Request $request, $user)
    {
         //UPDATE DATA
         User::where('username', $request['username'])->update([
            'last_login'      => Carbon::now()
        ]);
    }

    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'deleted_at' => null];
    }

    public function showLoginForm()
    {
        $setting = $this->setting();
        return view('auth.login', get_defined_vars());
    }
}
