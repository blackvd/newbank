<?php

namespace App\Http\Controllers\User;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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

    public function index()
    {
        $client = Client::where("id", Auth::user()->client_id)->first();
        return view('user.account.index', ['client' => $client]);
    }
}
