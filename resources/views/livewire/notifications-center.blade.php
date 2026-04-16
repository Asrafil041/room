<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan Masuk</h2>
            @if ($unreadCount > 0)
                <button
                    type="button"
                    wire:click="markAllAsRead"
                    class="inline-flex items-center rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700"
                >
                    Tandai semua dibaca
                </button>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Kegiatan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ruangan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Waktu Mulai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Waktu Berakhir</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Waktu Notif</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($notifications as $notification)
                                @php($isUnread = is_null($notification->read_at))
                                @php($statusType = $notification->data['type'] ?? 'info')
                                <tr class="{{ $isUnread ? 'bg-emerald-50/60' : '' }}">
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $notification->data['activity'] ?? '-' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $notification->data['room_name'] ?? '-' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">
                                        @if (!empty($notification->data['start_time']))
                                            {{ \Carbon\Carbon::parse($notification->data['start_time'])->translatedFormat('d M Y, H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-700">
                                        @if (!empty($notification->data['end_time']))
                                            {{ \Carbon\Carbon::parse($notification->data['end_time'])->translatedFormat('d M Y, H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $notification->data['message'] ?? 'Notifikasi baru.' }}</td>
                                    <td class="px-4 py-4 text-sm">
                                        @if ($statusType === 'approved')
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-700">Disetujui</span>
                                        @elseif ($statusType === 'rejected')
                                            <span class="inline-flex rounded-full bg-rose-100 px-2 py-1 text-xs font-semibold text-rose-700">Ditolak</span>
                                        @elseif ($statusType === 'locked')
                                            <span class="inline-flex rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">Dibatalkan Sistem</span>
                                        @else
                                            <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">Info</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $notification->created_at?->translatedFormat('d M Y, H:i') }}</td>
                                    <td class="px-4 py-4 text-right">
                                        @if ($isUnread)
                                            <button
                                                type="button"
                                                wire:click="markAsRead('{{ $notification->id }}')"
                                                class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50"
                                            >
                                                Tandai dibaca
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-600">Sudah dibaca</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">Belum ada notifikasi untuk akun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if (method_exists($notifications, 'links'))
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
