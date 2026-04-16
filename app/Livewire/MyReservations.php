<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MyReservations extends Component
{
    public function render()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest() // Biar yang terbaru ada di paling atas
            ->get();

        return view('livewire.my-reservations', [
            'reservations' => $reservations
        ])->layout('layouts.app');
    }
}