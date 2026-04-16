<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">Admin: Panel Persetujuan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="mb-4 bg-blue-100 p-4 rounded-lg text-blue-700">{{ session('message') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ruangan & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations as $res)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $res->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $res->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="font-bold text-indigo-600">{{ $res->room->name }}</span><br>
                                    {{ \Carbon\Carbon::parse($res->start_time)->format('d M, H:i') }} -
                                    {{ \Carbon\Carbon::parse($res->end_time)->format('d M, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $res->purpose }}</td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <button
                                        type="button"
                                        wire:click="approve({{ $res->id }})"
                                        class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm font-medium"
                                        style="background-color:#16a34a;color:#ffffff;border:1px solid #15803d;"
                                    >
                                        Setujui
                                    </button>
                                    <button
                                        type="button"
                                        wire:click="reject({{ $res->id }})"
                                        class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium"
                                        style="background-color:#dc2626;color:#ffffff;border:1px solid #b91c1c;"
                                    >
                                        Tolak
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500">Antrean kosong, aman bos!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>