<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        $artikel = Artikel::when($search, function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%");
            })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->latest()
            ->paginate(6);

        return view('artikel', compact('artikel', 'search', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'nullable|string',
            'konten' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/artikel'), $nama);
            $gambarPath = 'uploads/artikel/' . $nama;
        }

        Artikel::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'gambar' => $gambarPath,
        ]);

        return back()->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
                unlink(public_path($artikel->gambar));
            }
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/artikel'), $nama);
            $artikel->gambar = 'uploads/artikel/' . $nama;
        }

        $artikel->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
        ]);

        return back()->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
            unlink(public_path($artikel->gambar));
        }

        $artikel->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    public function show(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Cegah spam view (1 IP hanya dihitung setiap 2 menit)
        $key = "artikel_viewed_" . $id . "_" . $request->ip();

        if (!cache()->has($key)) {
            $artikel->increment('views');
            cache()->put($key, true, 120); // IP dihitung 1x/2 menit
        }

        return view('artikel_show', compact('artikel'));
    }

    // ROUTE AJAX realtime untuk ambil view terbaru
    public function getViews($id)
    {
        return Artikel::findOrFail($id)->views;
    }
}
