<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::all();
        return view('pengurus', compact('pengurus'));
    }

    public function create()
    {
        return view('pengurus_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/pengurus'), $filename);

        Pengurus::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $filename
        ]);

        return back()->with('success', 'Data pengurus berhasil disimpan');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('pengurus_edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $p = Pengurus::findOrFail($id);

        $p->nama = $request->nama;
        $p->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/pengurus'), $filename);
            $p->foto = $filename;
        }

        $p->save();

        return back()->with('success', 'Data pengurus berhasil diupdate');
    }
    public function destroy($id)
    {
        $p = Pengurus::findOrFail($id);

        if ($p->foto && file_exists(public_path('images/pengurus/' . $p->foto))) {
            unlink(public_path('images/pengurus/' . $p->foto));
        }

        $p->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

}
