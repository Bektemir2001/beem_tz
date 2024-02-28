<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ERController extends Controller
{
    public function index()
    {
        return view('er.index');
    }
}
