<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenAccountController extends Controller
{
    public function Index(){
        return view('open_account');
    }
}
