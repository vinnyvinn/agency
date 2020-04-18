<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function signIn(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user){
            Auth::login($user);
            if (Auth::check()){
                return response('successful');
            }else{
                return response('error');
            }
        }
        return response()->json('nouser');
    }
    public function logout(Request $request)
    {

        $this->guard()->logout();
        if (isset($_COOKIE['auth_email'])) {
            unset($_COOKIE['auth_email']);
            setcookie("auth_email", "", time() - 300,"/",env('COOKIE_EXTENSION'));
        }
        return redirect()->away(env('DASHBOARD_URL').'/logout');
    }
}
