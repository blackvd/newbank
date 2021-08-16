<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/admin/dashboard";



    public function __construct() {
        $this->middleware('guest:admin')->except("logout");
    }


    public function showAdminLogin(){
        return view('admin.auth.login');
    }

    public function adminLogin(){
        $this->validate(request(),[
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if($this->guard()->attempt(['username' => request()->username, 'password' => request()->password]))
            return redirect(route("admin.dashboard"));

        return back()->withInput(request()->only('username'))->with('error_msg', 'Nom d\'utilisateur ou mot de passe incorrect');
    }

    public function adminLogout(Request $req)
    {
        dd($req);
        $this->guard()->logout();
        $req->session()->invaliddate();
        return redirect(route('admin.login'));
    }

    protected function guard()
    {
        return Auth::guard("admin");
    }

}
