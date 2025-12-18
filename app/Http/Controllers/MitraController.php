<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;
        $kategori = $request->kategori;

        $query = Mitra::query();

        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('deskripsi', 'like', "%$search%");
        }

        if ($kategori && $kategori !== 'all') {
            $query->where('kategori', $kategori);
        }

        $mitras = $query->orderBy('nama')->get();

        $kategoriList = Mitra::select('kategori')->distinct()->pluck('kategori');

        return view('mitrakami', compact('mitras', 'kategoriList', 'search', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'logo' => 'image|mimes:png,jpg,jpeg|max:4096',
        ]);

        $filename = null;
        if ($request->hasFile('logo')) {
            $filename = time().'_'.$request->logo->getClientOriginalName();
            $request->logo->move(public_path('images/mitra'), $filename);
        }

        Mitra::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'logo' => $filename
        ]);

        return back()->with('success', 'Mitra berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $filename = $mitra->logo;
        if ($request->hasFile('logo')) {
            $filename = time().'_'.$request->logo->getClientOriginalName();
            $request->logo->move(public_path('images/mitra'), $filename);
        }

        $mitra->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'logo' => $filename
        ]);

        return back()->with('success', 'Mitra berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return back()->with('success', 'Mitra berhasil dihapus!');
    }
}

