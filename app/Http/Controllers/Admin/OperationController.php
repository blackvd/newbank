<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationController extends Controller
{
    public function creditIndex()
    {
        $clients = Client::all()->sortByDesc("created_at");
        return view("admin.credit.index", compact('clients'));
    }
}
