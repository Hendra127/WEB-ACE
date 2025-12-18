<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Gallery;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'services' => Service::all(),
            'galleries' => Gallery::all(),
            'setting' => Setting::first()
        ]);
    }
}
