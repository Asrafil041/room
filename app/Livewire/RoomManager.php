<?php

namespace App\Livewire;

use App\Notifications\ReservationStatusUpdated; // Jangan lupa impor ini
use App\Models\Reservation;
use App\Models\Room;
use Livewire\Component;

class RoomManager extends Component
{
    public function toggleStatus(int $id): void
    {
        $room = Room::findOrFail($id);
        $isActiveBaru = !$room->is_active;
        $room->update(['is_active' => $isActiveBaru]);

        // Logika Sabotase: Jika ruangan dimatikan, batalkan semua jadwal terkait
        if (!$isActiveBaru) {
            $korbanReservasi = Reservation::with(['user', 'room'])
                ->where('room_id', $room->id)
                ->whereIn('status', ['pending', 'approved'])
                ->get();

            foreach ($korbanReservasi as $res) {
                $pesan = "WADUH! Ruangan {$room->name} mendadak dikunci admin. Jadwal lo terpaksa dibatalkan sistem.";
                $res->user->notify(new ReservationStatusUpdated($pesan, 'locked', [
                    'activity' => $res->purpose,
                    'room_name' => $room->name,
                    'start_time' => $res->start_time,
                    'end_time' => $res->end_time,
                ]));
                $res->update(['status' => 'rejected', 'admin_notes' => 'Ruangan dinonaktifkan darurat.']);
            }

            session()->flash('message', "Ruangan dikunci dan {$korbanReservasi->count()} mahasiswa telah dikabari!");
        } else {
            session()->flash('message', "Ruangan berhasil dibuka kembali!");
        }
    }

    public function render()
    {
        $rooms = Room::query()
            ->latest()
            ->get();

        return view('livewire.room-manager', [
            'rooms' => $rooms,
        ])->layout('layouts.app');
    }
}