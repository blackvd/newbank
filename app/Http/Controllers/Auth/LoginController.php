<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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

    public function userFirstLogin(){
        $this->validate(request(),[
            'first_con_name' => 'required',
            'password_current' => 'required',
            'password_new' => 'required|confirmed|min:8',
        ]);

        $user = User::where([['name', request()->first_con_name], ['password', request()->password_current]])->first();
        
        if($user){
            if($user->enabled != 1){
                $user->password = Hash::make(request()->password_new);
                $user->enabled = 1;
                $user->save();

                return redirect()->route('login')->with('success_msg', 'Votre compte a bien été activé, vous pouvez à présent vous connecter !');
            }
            return redirect()->route('login')->with('error_msg', 'Votre compte a déjà été activé !');
        }

        return redirect()->route('login')->with('error_msg', 'Vos accès sont incorrect veuillez réessayer');
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

    public function username(){
        return 'name';
    }
}
