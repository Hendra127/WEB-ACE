<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        return view('aboutus'); // name file aboutus.blade.php
    }
}
