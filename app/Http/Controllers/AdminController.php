<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Mitra;
use App\Models\About;
use App\Models\Pengurus;
use App\Models\Pembina;
use App\Models\Event;
use App\Models\Lowongan;

class AdminController extends Controller
{
    public function index(Request $request, $page = 'dashboard')
    {
        if ($page === 'galeri') {
            $galeri = Galeri::all();
            return view('admin.index', compact('page','galeri'));
        }

        if ($page === 'mitrakami') {
            $query = Mitra::query();

            if ($request->q) {
                $query->where('nama', 'like', "%{$request->q}%")
                      ->orWhere('deskripsi', 'like', "%{$request->q}%");
            }

            $mitras = $query->orderBy('created_at', 'desc')->get();
            return view('admin.index', compact('page','mitras'));
        }

        if ($page === 'pembina') {
            $pembinas = Pembina::orderBy('nama')->get();
            return view('admin.index', compact('page','pembinas'));
        }

         if ($page === 'pengurus') {
            $pengurus = Pengurus::orderBy('nama')->get();
            return view('admin.index', compact('page','pengurus'));
        }

        if ($page === 'upcoming-event') {
            $events = Event::orderBy('tanggal_event', 'asc')->get();
            return view('admin.index', compact('page','events'));
        }

        if ($page === 'about') {
            $abouts = About::all();
            return view('admin.index', compact('page','abouts'));
        }

        if ($page === 'lowongan') {
            $lowongan = Lowongan::latest()->get();
            return view('admin.index', compact('page','lowongan'));
        }

        // default: dashboard
        return view('admin.index', compact('page'));
    }    
}
