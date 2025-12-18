<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $events = $query->orderBy('tanggal_event', 'asc')->get();
        $featuredEvents = Event::orderBy('tanggal_event', 'asc')->take(3)->get();

        return view('upcoming-event', compact('events', 'featuredEvents'));
    }

    // Tambah Event
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required',
            'tanggal_event' => 'required|date',
            'jam_event' => 'required',
            'lokasi' => 'required|string',
            'status' => 'required|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = null;

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/event'), $filename);
            $path = "uploads/event/" . $filename;
        }

        Event::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'tanggal_event' => $request->tanggal_event,
            'jam_event' => $request->jam_event,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'gambar' => $path, // disesuaikan dengan field database
            'views' => 0,
        ]);

        return back()->with('success', 'Event berhasil ditambahkan!');
    }

    // Update Event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required',
            'tanggal_event' => 'required|date',
            'jam_event' => 'required',
            'lokasi' => 'required|string',
            'status' => 'required|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = $event->gambar; // sesuai field database

        if ($request->hasFile('banner')) {
            if ($path && File::exists(public_path($path))) {
                File::delete(public_path($path));
            }

            $file = $request->file('banner');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/event'), $filename);
            $path = "uploads/event/" . $filename;
        }

        $event->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'tanggal_event' => $request->tanggal_event,
            'jam_event' => $request->jam_event,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'gambar' => $path, // sesuai field database
        ]);

        return back()->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->gambar && File::exists(public_path($event->gambar))) {
            File::delete(public_path($event->gambar));
        }

        $event->delete();

        return back()->with('success', 'Event berhasil dihapus!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event-detail', compact('event'));
    }
    public function getViews($id)
    {
        $event = Event::findOrFail($id);
        $event->views += 1;
        $event->save();

        return response()->json(['views' => $event->views]);
    }

    // RSVP / Ikut Event
    public function rsvp($id)
    {
        $event = Event::findOrFail($id);
        // Logika RSVP: bisa simpan ke tabel peserta atau kirim notifikasi
        // Misal redirect back dengan pesan sukses:
        return back()->with('success', "Anda berhasil mendaftar di event: {$event->judul}");
    }

    // Simpan ke Kalender
    public function calendar($id)
    {
        $event = Event::findOrFail($id);
        $start = date('Ymd\THis\Z', strtotime($event->tanggal_event . ' ' . $event->jam_event));
        $end = date('Ymd\THis\Z', strtotime($event->tanggal_event . ' ' . $event->jam_event . ' +2 hours'));

        $icsContent = "BEGIN:VCALENDAR
    VERSION:2.0
    PRODID:-//Acme Corp//Events//EN
    BEGIN:VEVENT
    UID:{$event->id}@acelombok.nustech.co.id
    DTSTAMP:".gmdate('Ymd\THis\Z')."
    DTSTART:{$start}
    DTEND:{$end}
    SUMMARY:{$event->judul}
    DESCRIPTION:{$event->deskripsi}
    LOCATION:{$event->lokasi}
    END:VEVENT
    END:VCALENDAR";

        $filename = "event-{$event->id}.ics";
        return response($icsContent)
                ->header('Content-Type', 'text/calendar')
                ->header('Content-Disposition', "attachment; filename={$filename}");
    }

}