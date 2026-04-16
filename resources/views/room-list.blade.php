<div class="p-6 text-gray-900">
    <h2 class="text-2xl font-bold mb-6">Pilih Ruangan</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @foreach($rooms as $room)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $room->name }}</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ $room->type }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">
                        <span class="font-medium">Kapasitas:</span> {{ $room->capacity }} Orang
                    </p>

                    <button class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150">
                        Lihat Jadwal & Booking
                    </button>
                </div>
            </div>
        @endforeach

    </div>
</div>