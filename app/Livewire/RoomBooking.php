<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class RoomBooking extends Component
{
    public Room $room;
    public $start_time;
    public $end_time;
    public $purpose;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function store()
    {
        // 1. Uji Penalaran: Validasi Input Dasar
        // Nggak mungkin dong end_time lebih duluan dari start_time? Kita blokir di sini.
        $this->validate([
            'purpose' => 'required|string|max:255',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // 2. Logika "Irisan" (Overlap Detection)
        $isExists = Reservation::where('room_id', $this->room->id)
            ->whereIn('status', ['pending', 'approved']) // Cek yang pending juga biar ga dobel
            ->where(function ($query) {
                $query->where('start_time', '<', $this->end_time)
                      ->where('end_time', '>', $this->start_time);
            })
            ->exists();

        // 3. Keputusan Eksekusi
        if ($isExists) {
            // Kalau bentrok, lempar pesan error ke layar
            session()->flash('error', 'Waduh, jam segitu ruangannya udah dipake atau lagi diproses orang lain!');
            return;
        }

        // Kalau lolos ujian bentrok, simpan datanya!
        Reservation::create([
            'user_id' => Auth::id(), // ID mahasiswa yang lagi login
            'room_id' => $this->room->id,
            'purpose' => $this->purpose,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => 'pending', // Default nunggu admin
        ]);

        // Kasih notif sukses dan kosongin form
        session()->flash('success', 'Booking berhasil diajukan! Silakan tunggu konfirmasi admin.');
        $this->reset(['purpose', 'start_time', 'end_time']);
    }

    public function render()
    {
        return view('livewire.room-booking')->layout('layouts.app');
    }
}