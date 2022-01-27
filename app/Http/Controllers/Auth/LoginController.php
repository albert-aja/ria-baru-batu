<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    protected $redirectTo;

    public function redirectTo(Request $request)
    {
        if ($request->user()->hasRole('Admin')) {
            $this->redirectTo = route('Admin Beranda');
            return $this->redirectTo;
        } else if ($request->user()->hasRole('Operator Excavator')) {
            $this->redirectTo = route('Operator Excavator Beranda');
            return $this->redirectTo;
        } else if ($request->user()->hasRole('Supir')) {
            $this->redirectTo = route('Supir Beranda');
            return $this->redirectTo;
        } else if ($request->user()->hasRole('Owner')) {
            $this->redirectTo = route('Owner Beranda');
            return $this->redirectTo;
        } else {
            Auth::logout();
            //return redirect()->route('Keluar');
        }
    }

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

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $data = Arr::add($credentials, 'status', '1');
        return $data;
    }

    protected function authenticated(Request $request, $user)
    {
        alert()->success('' . General::get_greetings() . ' ' . $user->name . '', 'Login Berhasil');
        if ($request->user()->hasRole('Admin')) {
            return redirect()->route('Admin Beranda');
        } else if ($request->user()->hasRole('Operator Excavator')) {
            return redirect()->route('Operator Excavator Beranda');
        } else if ($request->user()->hasRole('Supir')) {
            return redirect()->route('Supir Beranda');
        } else if ($user->hasRole('Owner')) {
            return redirect()->route('Owner Beranda');
        } else {
            Auth::logout();
        }
    }
}
