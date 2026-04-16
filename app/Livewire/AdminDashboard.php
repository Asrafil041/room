<?php

namespace App\Livewire;

use App\Notifications\ReservationStatusUpdated; // Jangan lupa impor ini
use App\Models\Reservation;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function approve(int $id): void
    {
        $reservation = Reservation::with('user', 'room')->findOrFail($id);
        $reservation->update(['status' => 'approved']);

        $pesan = "Hore! Jadwal minjem {$reservation->room->name} lo udah di-ACC.";
        $reservation->user->notify(new ReservationStatusUpdated($pesan, 'approved', [
            'activity' => $reservation->purpose,
            'room_name' => $reservation->room->name,
            'start_time' => $reservation->start_time,
            'end_time' => $reservation->end_time,
        ]));

        session()->flash('message', 'Reservasi disetujui dan notif terkirim!');
    }

    public function reject(int $id): void
    {
        $reservation = Reservation::with('user', 'room')->findOrFail($id);
        $reservation->update(['status' => 'rejected']);

        $pesan = "Maaf ngab, jadwal lo di {$reservation->room->name} ditolak admin.";
        $reservation->user->notify(new ReservationStatusUpdated($pesan, 'rejected', [
            'activity' => $reservation->purpose,
            'room_name' => $reservation->room->name,
            'start_time' => $reservation->start_time,
            'end_time' => $reservation->end_time,
        ]));

        session()->flash('message', 'Reservasi ditolak dan notif terkirim.');
    }

    public function render()
    {
        $reservations = Reservation::with(['user', 'room'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('livewire.admin-dashboard', [
            'reservations' => $reservations,
        ])->layout('layouts.app');
    }
}