<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal_event',
        'jam_event',
        'status',
        'gambar',
        'views',
    ];
}
