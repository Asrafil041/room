<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReservationStatusUpdated extends Notification
{
    use Queueable;

    private string $message;
    private string $statusType;
    private array $details;

    public function __construct(string $message, string $statusType, array $details = [])
    {
        $this->message = $message;
        $this->statusType = $statusType; // contoh: 'approved', 'rejected', 'locked'
        $this->details = $details;
    }

    public function via(object $notifiable): array
    {
        // Memaksa sistem untuk mendaratkan pesan di tabel pangkalan data
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        // Struktur data JSON yang akan dibaca oleh halaman mahasiswa
        return [
            'message' => $this->message,
            'type' => $this->statusType,
            'time' => now()->toDateTimeString(),
            'activity' => $this->details['activity'] ?? null,
            'room_name' => $this->details['room_name'] ?? null,
            'start_time' => $this->details['start_time'] ?? null,
            'end_time' => $this->details['end_time'] ?? null,
        ];
    }
}