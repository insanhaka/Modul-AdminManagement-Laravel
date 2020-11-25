<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontbusinessunitController extends Controller
{
    public function index()
    {
        return view('Frontend.businessunit');
    }
}
