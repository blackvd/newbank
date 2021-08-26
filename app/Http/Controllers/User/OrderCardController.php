<?php

namespace App\Http\Controllers\User;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderCardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       
        $user = Client::find(Auth::user()->client_id)->first();
        return view('user.order_card.index', ["user" => $user]);
    }
}
