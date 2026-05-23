<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-blue-100 p-8 flex items-center justify-between transition transform hover:-translate-y-1">
                <div>
                    <p class="text-sm font-bold text-blue-500 uppercase tracking-wider mb-1">Total Timbangan Hari Ini</p>
                    <h3 class="text-4xl font-extrabold text-gray-800">{{ $totalWeighingsToday }} <span class="text-lg text-gray-500 font-medium">Transaksi</span></h3>
                </div>
                <div class="p-4 bg-blue-50 rounded-full border border-blue-100">
                    <svg width="32" height="32" style="width: 32px; height: 32px;" class="text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-green-100 p-8 flex items-center justify-between transition transform hover:-translate-y-1">
                <div>
                    <p class="text-sm font-bold text-green-500 uppercase tracking-wider mb-1">Total Berat Netto Hari Ini</p>
                    <h3 class="text-4xl font-extrabold text-gray-800">{{ number_format($totalNetWeightToday, 2, ',', '.') }} <span class="text-lg text-gray-500 font-medium">KG</span></h3>
                </div>
                <div class="p-4 bg-green-50 rounded-full border border-green-100">
                    <svg width="32" height="32" style="width: 32px; height: 32px;" class="text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
            
            <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between bg-white">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-extrabold text-gray-800 flex items-center">
                        <svg width="24" height="24" style="width: 24px; height: 24px;" class="text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Riwayat Timbangan
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Daftar pencatatan timbangan barang dan kendaraan.</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="relative w-full md:w-auto flex space-x-2">
                        <!-- Search Box -->
                        <div class="relative w-full md:w-auto flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg width="20" height="20" style="width: 20px; height: 20px;" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input wire:model.live="search" type="text" class="pl-10 block w-full rounded-full border-gray-300 bg-gray-50 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 transition" placeholder="Cari Plat / No TTBM...">
                        </div>
                        
                        <!-- Period Filter -->
                        <select wire:model.live="periodFilter" class="block w-full md:w-auto rounded-full border-gray-300 bg-gray-50 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 transition cursor-pointer">
                            <option value="all">Semua Waktu</option>
                            <option value="today">Hari Ini</option>
                            <option value="weekly">Minggu Ini</option>
                            <option value="monthly">Bulan Ini</option>
                            <option value="yearly">Tahun Ini</option>
                        </select>
                    </div>

                    <!-- Single Export Button (Exports what is currently filtered) -->
                    <button wire:click="exportExcel" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-2 bg-green-600 border border-transparent rounded-full font-bold text-white tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export Excel
                    </button>

                    <a href="{{ route('weighings.create') }}" class="w-full md:w-auto inline-flex justify-center items-center px-6 py-2 bg-blue-600 border border-transparent rounded-full font-bold text-white tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow-md">
                        + Tambah Baru
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No. TTBM</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kendaraan / Sopir</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Barang</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Netto (KG)</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($weighings as $w)
                            <tr class="hover:bg-blue-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $w->receipt_date->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $w->receipt_date->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-md bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $w->ticket_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-800">{{ $w->vehicle->plate_number ?? '-' }}</div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        👨‍✈️ {{ $w->driver->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                                    {{ $w->item->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="text-base font-bold font-mono {{ $w->net_weight > 0 ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ number_format($w->net_weight, 2, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button wire:click="openViewModal({{ $w->id }})" title="Detail Data" class="inline-flex items-center p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 hover:text-emerald-800 rounded-lg transition font-bold border border-emerald-100 cursor-pointer">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                        
                                        <button wire:click="openPrintModal({{ $w->id }})" title="Print Struk" class="inline-flex items-center p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 rounded-lg transition font-bold border border-blue-100 cursor-pointer">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        </button>
                                        
                                        <a href="{{ route('weighings.edit', $w->id) }}" title="Edit Data" class="inline-flex items-center p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-800 rounded-lg transition font-bold border border-amber-100 cursor-pointer">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <button wire:click="confirmDelete({{ $w->id }})" title="Hapus Data" class="inline-flex items-center p-2 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-800 rounded-lg transition font-bold border border-red-100 cursor-pointer">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg width="48" height="48" style="width: 48px; height: 48px;" class="mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Belum ada data timbangan yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($weighings->hasPages())
                <div class="px-8 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $weighings->links() }}
                </div>
            @endif
            
        </div>
    </div>

    <!-- Modal Cetak Struk -->
    <x-dialog-modal wire:model.live="showPrintModal" maxWidth="3xl">
        <x-slot name="title">
            <div class="font-bold text-xl text-gray-800">Pratinjau Cetak Bukti Timbangan</div>
        </x-slot>

        <x-slot name="content">
            @if($printUrl)
                <div class="bg-gray-100 rounded-lg p-2 overflow-hidden border border-gray-300 h-[75vh]">
                    <iframe src="{{ $printUrl }}" class="w-full h-full border-none rounded bg-white shadow-inner"></iframe>
                </div>
                <div class="mt-4 text-sm text-gray-500 text-center flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Jika kotak dialog print tidak muncul otomatis, klik kanan pada area invoice lalu pilih "Print/Cetak".
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end gap-3 w-full">
                <button type="button" wire:click="closePrintModal" wire:loading.attr="disabled" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors">
                    Tutup
                </button>
                <a href="{{ $printUrl }}" target="_blank" class="inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Buka di Tab Baru
                </a>
            </div>
        </x-slot>
    </x-dialog-modal>

    <!-- Modal Detail Data -->
    <x-dialog-modal wire:model.live="showViewModal" maxWidth="2xl">
        <x-slot name="title">
            <div class="font-extrabold text-2xl text-blue-900 flex items-center border-b border-blue-100 pb-4">
                <svg width="28" height="28" class="mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Detail Timbangan #{{ $selectedWeighing ? $selectedWeighing->ticket_number : '' }}
            </div>
        </x-slot>

        <x-slot name="content">
            @if($selectedWeighing)
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase mb-1">Tanggal & Waktu</p>
                            <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($selectedWeighing->receipt_date)->format('d F Y - H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase mb-1">Kendaraan</p>
                            <div class="inline-flex items-center px-3 py-1 rounded-md bg-yellow-100 text-yellow-800 font-mono font-bold text-lg border border-yellow-200">
                                {{ $selectedWeighing->vehicle->plate_number ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-6 mb-6">
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Sopir</p>
                            <p class="font-bold text-gray-800 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $selectedWeighing->driver->name ?? '-' }}
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Barang</p>
                            <p class="font-bold text-gray-800 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                {{ $selectedWeighing->item->name ?? '-' }}
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Pengirim / Supplier</p>
                            <p class="font-bold text-gray-800 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $selectedWeighing->sender->name ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl p-5 border border-blue-100 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-4">
                        <div class="flex-1">
                            <p class="text-xs font-bold text-blue-500 uppercase mb-1">Bruto (Kotor)</p>
                            <p class="text-xl font-mono font-bold text-blue-900">{{ number_format($selectedWeighing->gross_weight, 2, ',', '.') }} kg</p>
                        </div>
                        <div class="text-blue-300 font-bold text-2xl hidden md:block">-</div>
                        <div class="flex-1">
                            <p class="text-xs font-bold text-blue-500 uppercase mb-1">Tara (Potongan)</p>
                            <p class="text-xl font-mono font-bold text-blue-900">{{ number_format($selectedWeighing->tare_weight, 2, ',', '.') }} kg</p>
                        </div>
                        <div class="text-blue-300 font-bold text-2xl hidden md:block">=</div>
                        <div class="flex-1 bg-white py-2 px-4 rounded-lg shadow-sm border border-blue-200">
                            <p class="text-xs font-extrabold text-green-600 uppercase mb-1">Netto (Bersih)</p>
                            <p class="text-2xl font-mono font-black text-green-700">{{ number_format($selectedWeighing->net_weight, 2, ',', '.') }} kg</p>
                        </div>
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="closeViewModal" class="inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-2.5 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Tutup
            </button>
        </x-slot>
    </x-dialog-modal>
</div>