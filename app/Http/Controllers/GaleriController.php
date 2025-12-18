<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();
        $kategori = Galeri::select('kategori')->distinct()->pluck('kategori');

        return view('galeri', compact('galeri', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = time() . "." . $request->foto->extension();
        $request->foto->move(public_path('images/galeri'), $filename);

        Galeri::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $g = Galeri::findOrFail($id);

        $g->judul = $request->judul;
        $g->kategori = $request->kategori;
        $g->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $filename = time() . "." . $request->foto->extension();
            $request->foto->move(public_path('images/galeri'), $filename);
            $g->foto = $filename;
        }

        $g->save();
        return back()->with('success', 'Foto berhasil diperbarui');
    }

    public function destroy($id)
    {
        $g = Galeri::findOrFail($id);

        // hapus file fisik
        $path = public_path('images/galeri/' . $g->foto);
        if (file_exists($path)) unlink($path);

        $g->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}

