<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Route
Route::get('/aboutus', [AboutController::class, 'index'])->name('aboutus');
Route::get('/pembina', [HomeController::class, 'pembina'])->name('pembina');

// Pembina Routes (yang benar)
Route::get('/pembina', [PembinaController::class, 'index'])->name('pembina');
Route::get('/pembina/create', [PembinaController::class, 'create'])->name('pembina.create');
Route::post('/pembina/store', [PembinaController::class, 'store'])->name('pembina.store');
Route::get('/pembina/{id}/edit', [PembinaController::class, 'edit'])->name('pembina.edit');
Route::put('/pembina/{id}', [PembinaController::class, 'update'])->name('pembina.update');
Route::delete('/pembina/{id}', [PembinaController::class, 'destroy'])->name('pembina.destroy');

// Pengurus Routes
Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');
Route::post('/pengurus/store', [PengurusController::class, 'store'])->name('pengurus.store');
Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->name('pengurus.update');
Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');
Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('pengurus.create');

// Gallery Route
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');


// Mitra Routes
Route::get('/mitra', [MitraController::class, 'index'])->name('mitrakami');
Route::post('/mitra', [MitraController::class, 'store'])->name('mitra.store');
Route::put('/mitra/{id}', [MitraController::class, 'update'])->name('mitra.update');
Route::delete('/mitra/{id}', [MitraController::class, 'destroy'])->name('mitra.destroy');

// Lowongan Routes
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan');
Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');
Route::post('/lowongan/store', [LowonganController::class, 'store'])->name('lowongan.store');
Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');

// Artikel Routes
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('artikel.store');
Route::post('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
Route::delete('/artikel/delete/{id}', [ArtikelController::class, 'destroy'])->name('artikel.delete');

Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// AJAX realtime view counter
Route::get('/artikel/views/{id}', [ArtikelController::class, 'getViews']);

// Upcoming Event Routes
Route::get('/upcoming-event', [EventController::class, 'index'])->name('upcoming-event');
Route::get('/upcoming-event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/event/views/{id}', [EventController::class, 'getViews'])->name('event.views');

Route::post('/admin/event/store', [EventController::class, 'store'])->name('event.store');
Route::put('/admin/event/update/{id}', [EventController::class, 'update'])->name('event.update');
Route::delete('/admin/event/delete/{id}', [EventController::class, 'destroy'])->name('event.destroy');

Route::get('/event/{id}/rsvp', [EventController::class, 'rsvp'])->name('event.rsvp');
Route::get('/event/{id}/calendar', [EventController::class, 'calendar'])->name('event.calendar');

// Authentication Routes Middleware IsAdmin
Route::get('/admin/{page?}', [AdminController::class, 'index']);

// halaman login
Route::get('/loginpage', function () {
    return view('loginpage');
})->name('loginpage');

// proses login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');
// proses logout
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('loginpage');