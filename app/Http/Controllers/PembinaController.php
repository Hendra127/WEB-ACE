<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    // Halaman pembina
    public function index()
    {
        $pembinas = Pembina::all();
        return view('pembina', compact('pembinas'));
    }

    // Form tambah pembina
    public function create()
    {
        return view('pembina_create');
    }

    // Proses simpan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload foto
        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/pembina'), $filename);

        // simpan database
        Pembina::create([
            'nama' => $request->nama,
            'foto' => $filename
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
    public function edit($id)
    {
        $pembina = Pembina::findOrFail($id);
        return view('pembina_edit', compact('pembina'));
    }

    public function update(Request $request, $id)
    {
        $p = Pembina::findOrFail($id);

        $p->nama = $request->nama;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/pembina'), $fotoName);
            $p->foto = $fotoName;
        }

        $p->save();

        return back()->with('success', 'Data pembina berhasil diupdate');
    }

}
