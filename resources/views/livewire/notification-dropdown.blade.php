<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <button @click="open = ! open" class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none transition duration-150 ease-in-out" aria-label="Notifikasi" title="Notifikasi">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @if($unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                {{ $unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 z-50 mt-2 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
         style="display: none;">

        <div class="px-4 py-2 border-b flex justify-between items-center">
            <span class="text-sm font-bold text-gray-700">Notifikasi</span>
            @if($unreadNotifications->count() > 0)
                <button wire:click="markAllAsRead" class="text-xs text-blue-600 hover:text-blue-800">Baca Semua</button>
            @endif
        </div>

        <div class="max-h-64 overflow-y-auto">
            @forelse($unreadNotifications as $notif)
                <div class="px-4 py-3 border-b hover:bg-gray-50 flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-800">{{ $notif->data['message'] ?? 'Notifikasi baru.' }}</p>
                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($notif->data['time'] ?? $notif->created_at)->diffForHumans() }}</span>
                    </div>
                    <button wire:click="markAsRead('{{ $notif->id }}')" class="ml-2 text-gray-400 hover:text-green-500" title="Tandai sudah dibaca">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>
            @empty
                <div class="px-4 py-3 text-sm text-gray-500 text-center">Belum ada notifikasi baru.</div>
            @endforelse
        </div>
    </div>
</div>
