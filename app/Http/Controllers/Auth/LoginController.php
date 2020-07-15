<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    function  logout(Request $request){
        {
//            dd(Auth::guard('customer')->user()->name);
            Auth::guard('web')->logout();
            $activeGuards = 0;
            foreach (config('auth.guards') as $guard => $guardConfig) {
                if ($guardConfig['driver'] === 'session') {
                    $guardName = Auth::guard($guard)->getName();
                    if ($request->session()->has($guardName) && $request->session()->get($guardName) === Auth::guard($guard)->user()->getAuthIdentifier()) {
                        $activeGuards++;
                    }
                }
            }
            if ($activeGuards === 0) {
                $request->session()->flush();
                $request->session()->regenerate();
            }
            return redirect('/login');
        }
    }
    protected function guard()
    {
        return Auth::guard('web');
    }
}
