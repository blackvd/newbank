<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        // $accounts = Compte::all()->sortByDesc("created_at");
        $clients = Client::all()->sortByDesc("created_at");
        // dd($accounts[0]->client->civilite);

        return view("admin.account_managments.index", compact('clients'));
    }
}
