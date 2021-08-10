<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use Illuminate\Http\Request;

class AccountManagmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $accounts = Compte::all()->sortByDesc("created_at");

        return view("admin.account_managments.index", ["accounts" => $accounts]);
    }
}
