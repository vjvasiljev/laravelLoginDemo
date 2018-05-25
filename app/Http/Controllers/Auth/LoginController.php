<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => array(
                'required',
                'string',
                'max:12',
                'unique:users',
                'regex:/(^(((?!_)[a-zA-z\d])+)?$)/u'
            ),
            //'/[^a-z_\-0-9]/i'
            //'regex:/(^([a-zA-Z]+)(\d+)?$)/u'
            //'email' => 'required|string|email|max:255|unique:users',
            'password' => array(
                'required',
                'string',
                'min:6',
                'max:12',
                'confirmed',
                'regex:/(^(((?!_)[a-zA-z\d])+)?$)/u'
            ),
        ]);
    }

    public function postLogin(Request $request)
{
    $auth = false;
    $credentials = $request->only('username', 'password');
    

    if (Auth::attempt($credentials, $request->has('remember'))) {
        $auth = true; // Success
    }

    if ($request->ajax()) {
        return response()->json([
            'auth' => $auth,
            'intended' => URL::previous()
        ]);
    } else {
        return redirect()->intended(URL::route('home'));
    }
    return redirect(URL::route('login'));
}
}
