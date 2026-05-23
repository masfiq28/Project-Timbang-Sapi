<div class="py-10 bg-blue-50/50 min-h-screen">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-blue-100">
            <div class="p-6 sm:p-10">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 border-b border-blue-100 pb-6 gap-4">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-900 tracking-tight flex items-center">
                            <span class="mr-3 text-3xl">{{ $weighingModel ? '✏️' : '⚖️' }}</span> 
                            {{ $weighingModel ? 'Edit Timbangan' : 'Input Timbangan' }}
                        </h2>
                        <p class="text-sm text-blue-600/70 mt-1">{{ $weighingModel ? 'Ubah data timbangan untuk No. TTBM ' . $weighingModel->ticket_number : 'Silakan lengkapi data kendaraan dan hasil timbangan di bawah ini.' }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 border border-blue-200 text-blue-700 rounded-full text-sm font-bold whitespace-nowrap shadow-sm">
                        <svg width="16" height="16" style="width: 16px; height: 16px;" class="mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ now()->format('d M Y - H:i') }}
                    </span>
                </div>
                
                <form wire:submit.prevent="save" class="space-y-8">
                    
                    <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100">
                        <h3 class="text-sm font-bold text-blue-600 uppercase tracking-wider mb-5">Detail Informasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Kendaraan (Plat Nomor) <span class="text-red-500">*</span></label>
                                <input type="text" wire:model.live="vehicle_name" list="vehicles_list" class="w-full rounded-xl border-blue-200 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out text-base py-2.5 text-blue-900" placeholder="Ketik atau pilih Plat Nomor..." autocomplete="off">
                                <datalist id="vehicles_list">
                                    @foreach($vehicles as $v)
                                        <option value="{{ $v->plate_number }}"></option>
                                    @endforeach
                                </datalist>
                                @error('vehicle_name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                                <p class="text-xs text-blue-400 mt-2 flex items-start">
                                    <svg width="14" height="14" style="width: 14px; height: 14px;" class="mr-1.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Otomatis mengisi Sopir dan Barang jika ada di master data.
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Pengirim <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="sender_name" list="senders_list" class="w-full rounded-xl border-blue-200 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out text-base py-2.5 text-blue-900" placeholder="Ketik atau pilih Pengirim..." autocomplete="off">
                                <datalist id="senders_list">
                                    @foreach($senders as $s)
                                        <option value="{{ $s->name }}"></option>
                                    @endforeach
                                </datalist>
                                @error('sender_name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Sopir <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="driver_name" list="drivers_list" class="w-full rounded-xl border-blue-200 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out text-base py-2.5 text-blue-900" placeholder="Ketik atau pilih Sopir..." autocomplete="off">
                                <datalist id="drivers_list">
                                    @foreach($drivers as $d)
                                        <option value="{{ $d->name }}"></option>
                                    @endforeach
                                </datalist>
                                @error('driver_name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Barang <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="item_name" list="items_list" class="w-full rounded-xl border-blue-200 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out text-base py-2.5 text-blue-900" placeholder="Ketik atau pilih Barang..." autocomplete="off">
                                <datalist id="items_list">
                                    @foreach($items as $i)
                                        <option value="{{ $i->name }}"></option>
                                    @endforeach
                                </datalist>
                                @error('item_name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-800 p-1 rounded-3xl shadow-md">
                        <div class="bg-white rounded-[22px] p-6 sm:p-8">
                            <h2 class="text-2xl font-extrabold text-blue-900 flex items-center mb-6">
                                <svg width="24" height="24" style="width: 24px; height: 24px;" class="mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                {{ $weighingModel ? 'Edit Data Timbangan - ' . $weighingModel->ticket_number : 'Input Data Timbangan Baru' }}
                            </h2>
                            <p class="mt-1 text-sm text-blue-500 mb-6">
                                {{ $weighingModel ? 'Perbarui data timbangan yang sudah ada.' : 'Masukkan data timbangan untuk mencetak struk.' }}
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-blue-600 mb-2 uppercase tracking-wide">Berat Kotor (Bruto)</label>
                                    <div class="relative">
                                        <input type="number" step="0.01" wire:model.live="gross_weight" class="block w-full rounded-xl border-blue-200 bg-blue-50/50 shadow-inner focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-2xl font-mono font-semibold text-right text-blue-900 transition duration-150 ease-in-out py-3 pr-12" placeholder="0">
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-blue-400 font-bold">KG</span>
                                        </div>
                                    </div>
                                    @error('gross_weight') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-blue-600 mb-2 uppercase tracking-wide">Berat Tara</label>
                                    <div class="relative">
                                        <input type="number" step="0.01" wire:model.live="tare_weight" class="block w-full rounded-xl border-blue-200 bg-blue-50/50 shadow-inner focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-2xl font-mono font-semibold text-right text-blue-900 transition duration-150 ease-in-out py-3 pr-12" placeholder="0">
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-blue-400 font-bold">KG</span>
                                        </div>
                                    </div>
                                    @error('tare_weight') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="bg-blue-50 rounded-2xl p-4 border-2 border-blue-400 flex flex-col justify-center relative overflow-hidden">
                                    <div class="absolute -right-4 -top-4 opacity-10">
                                        <svg width="100" height="100" fill="currentColor" class="text-blue-600" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.15-1.92H8c.06 1.6 1.15 2.86 2.9 3.25V19h2.36v-1.66c1.63-.3 2.83-1.4 2.83-2.92-.01-2-.97-2.92-3.77-3.42z"/></svg>
                                    </div>
                                    <label class="block text-xs sm:text-sm font-extrabold text-blue-800 mb-1 uppercase tracking-tight sm:tracking-wide relative z-10">Berat Bersih (Netto)</label>
                                    <div class="w-full text-right relative z-10 flex items-baseline justify-end flex-wrap sm:flex-nowrap">
                                        <span class="text-3xl lg:text-4xl font-mono font-black text-blue-700 tracking-tighter break-all">{{ number_format($net_weight, 2) }}</span>
                                        <span class="text-blue-500 font-bold ml-1 text-sm lg:text-base">KG</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-end pt-4 gap-3">
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white border border-gray-300 rounded-xl font-bold text-gray-700 text-base tracking-wide hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2 transition-all duration-200 shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-blue-600 border border-transparent rounded-xl font-bold text-white text-base tracking-wide hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                            <svg width="20" height="20" style="width: 20px; height: 20px;" class="mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Data
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</div>