<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where([['name', $request->name], ['enabled', 1]])->first();
        if($user && $this->attemptLogin($request)){
            return $this->sendLoginResponse($request);
        }else{
            
            return redirect(route('login'))->with('error_msg', 'Veillez contacter votre gestionnaire si 
            vous ne parvenez pas a vous connecter');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function userFirstLogin(){
        $this->validate(request(),[
            'first_con_name' => 'required',
            'password_current' => 'required',
            'password_new' => 'required|confirmed|min:8',
        ]);

        $credentials = ["name" => request("first_con_name"), "password" => request("password_current")];
        if(Auth::once($credentials)){
            $user = User::where('name', request()->first_con_name)->first();
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

   
    public function username(){
        return 'name';
    }
}
