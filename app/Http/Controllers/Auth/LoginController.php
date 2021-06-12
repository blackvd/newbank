<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLogin(){
        return view('admin.auth.login');
    }

    public function adminLogin(){
        $this->validate(request(),[
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['username' => request()->username, 'password' => request()->password]))
            return redirect()->intended('/admin/dashboard');

        return back()->withInput(request()->only('username'))->with('error_msg', 'Nom d\'utilisateur ou mot de passe incorrect');
    }
}
