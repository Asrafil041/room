<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;

class RoomList extends Component
{
    public function render()
    {
        // Narik data ruangan yang aktif aja biar gak kena 'Jebakan Batman'
        $rooms = Room::where('is_active', true)->get();

        return view('livewire.room-list', [
            'rooms' => $rooms
        ]);
    }
}