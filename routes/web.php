<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AdminDashboard;
use App\Livewire\MyReservations;
use App\Livewire\NotificationsCenter;
use App\Livewire\RoomManager;
use App\Livewire\RoomBooking;
use App\Http\Middleware\IsAdmin;

// Rute Halaman Depan
Route::view('/', 'welcome');

// ==========================================
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// ==========================================

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    // ... rute lainnya ...
    Route::get('/my-reservations', MyReservations::class)->name('my-reservations');
    Route::get('/notifications', NotificationsCenter::class)->name('notifications.index');
    Route::get('/admin/dashboard', AdminDashboard::class)
        ->middleware([
            'auth',
            IsAdmin::class,
        ])
        ->name('admin.dashboard');

    Route::get('/admin/rooms', RoomManager::class)
        ->middleware([
            'auth',
            IsAdmin::class,
        ])
        ->name('admin.rooms');
});

// Rute Peminjaman Ruangan yang barusan kita buat
Route::middleware('auth')->group(function () {
    Route::get('/room/{room}', RoomBooking::class)->name('room.detail');
});

require __DIR__.'/auth.php';