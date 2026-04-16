<?php

namespace App\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationsCenter extends Component
{
    use WithPagination;

    public function markAsRead(string $notificationId): void
    {
        $user = auth()->user();

        if (! $user) {
            return;
        }

        $notification = $user->unreadNotifications()->find($notificationId);

        if ($notification instanceof DatabaseNotification) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead(): void
    {
        $user = auth()->user();

        if (! $user) {
            return;
        }

        $user->unreadNotifications->each->markAsRead();
    }

    public function render()
    {
        $user = auth()->user();

        $notifications = $user
            ? $user->notifications()->latest()->paginate(10)
            : collect();

        return view('livewire.notifications-center', [
            'notifications' => $notifications,
            'unreadCount' => $user?->unreadNotifications()->count() ?? 0,
        ])->layout('layouts.app');
    }
}
