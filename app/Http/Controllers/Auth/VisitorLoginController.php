<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitorLoginController extends Controller
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
        $this->middleware('guest:visitor')->except('logout');
    }

    public function login()
    {
        return view('visitor.auth.login');
    }
    public function loginVisitor(Request $request)
    {
//        dd('ds');
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        if (Auth::guard('visitor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('visitor.index'));

        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['status' => 'Email and Password don\'t match.']);
    }

    function  logout(Request $request){
        Auth::guard('visitor')->logout();
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
        return redirect('user/login');
    }

    protected function guard()
    {
        return Auth::guard('visitor');
    }

}
