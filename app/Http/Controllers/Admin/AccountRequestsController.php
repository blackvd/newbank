<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;

class AccountRequestsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account_requests = Client::all();
        return view('admin.account_requests.index', [
            'account_requests' => $account_requests
            ]);
    }

    public function show(string $trackId){
        $account = Client::where('track_id',$trackId)->first();

        return view("admin.account_requests.show", ["account" => $account]);
    }
}
