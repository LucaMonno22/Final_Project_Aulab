<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Qui potresti passare variabili alla vista se necessario
        return view('aboutus.aboutus');
    }
}