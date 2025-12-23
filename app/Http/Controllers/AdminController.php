<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index($page = 'dashboard')
    {
        if ($page === 'galeri') {
            $galeri = Galeri::all();
            return view('admin.index', compact('page','galeri'));
        }

        return view('admin.index', compact('page'));
    }    
}