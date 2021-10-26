<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountManagmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $clients = Client::all()->sortByDesc("created_at");
        return view("admin.account_managments.index", compact('clients'));
    }
}
