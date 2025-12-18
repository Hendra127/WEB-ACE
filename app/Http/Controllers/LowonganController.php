<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::latest()->get();
        return view('lowongan', compact('lowongan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/lowongan'), $filename);

        Lowongan::create([
            'image' => 'uploads/lowongan/'.$filename
        ]);

        return back()->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if ($request->hasFile('image')) {

            // Hapus file lama jika ada
            if (file_exists(public_path($lowongan->image))) {
                @unlink(public_path($lowongan->image));
            }

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/lowongan'), $filename);

            $lowongan->update([
                'image' => 'uploads/lowongan/'.$filename
            ]);
        }

        return back()->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if (file_exists(public_path($lowongan->image))) {
            @unlink(public_path($lowongan->image));
        }

        $lowongan->delete();

        return back()->with('success', 'Lowongan berhasil dihapus!');
    }
}
