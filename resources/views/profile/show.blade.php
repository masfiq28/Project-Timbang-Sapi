<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
        $totalWeighings = \App\Models\Weighing::count();
        $totalVehicles = \App\Models\Vehicle::count();
        $totalItems = \App\Models\Item::count();
    @endphp

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Header Premium with Ambient Lighting & Gradient (Forest Emerald Theme) -->
            <div class="relative bg-gradient-to-r from-emerald-700 via-teal-600 to-emerald-600 rounded-3xl overflow-hidden shadow-xl mb-8 p-6 sm:p-10 text-white">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.15),transparent)] mix-blend-overlay"></div>
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-black/20 rounded-full blur-3xl"></div>
                
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                    <!-- User Profile Glass Card -->
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative group">
                            <div class="absolute -inset-1.5 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full blur opacity-60 group-hover:opacity-100 transition duration-300"></div>
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="relative rounded-full size-24 object-cover border-4 border-white shadow-lg">
                        </div>
                        <div class="text-center sm:text-left">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-md border border-white/30 mb-2">
                                🛡️ Administrator
                            </span>
                            <h1 class="text-3xl font-extrabold tracking-tight">{{ $user->name }}</h1>
                            <p class="text-white/80 text-sm mt-1 flex items-center justify-center sm:justify-start gap-1.5">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $user->email }}
                            </p>
                            <p class="text-white/70 text-xs mt-1.5">
                                Bergabung sejak: {{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Live Stats Dashboard -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 bg-white/10 p-5 rounded-2xl border border-white/25 backdrop-blur-md w-full md:w-auto shadow-inner">
                        <div class="text-center px-2">
                            <span class="block text-2xl sm:text-3xl font-bold tracking-tight">{{ $totalWeighings }}</span>
                            <span class="text-[10px] sm:text-xs font-medium uppercase tracking-wider text-white/80">Timbang</span>
                        </div>
                        <div class="text-center px-2 border-x border-white/20">
                            <span class="block text-2xl sm:text-3xl font-bold tracking-tight">{{ $totalVehicles }}</span>
                            <span class="text-[10px] sm:text-xs font-medium uppercase tracking-wider text-white/80">Kendaraan</span>
                        </div>
                        <div class="text-center px-2">
                            <span class="block text-2xl sm:text-3xl font-bold tracking-tight">{{ $totalItems }}</span>
                            <span class="text-[10px] sm:text-xs font-medium uppercase tracking-wider text-white/80">Barang</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two-Column Tabbed Dashboard -->
            <div x-data="{ activeTab: 'profile' }" class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Left Navigation (Sidebar) -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-4 sm:p-5 rounded-3xl shadow-sm border border-gray-100/80">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 px-3">Pengaturan Akun</h3>
                        
                        <nav class="space-y-1">
                            <!-- Tab: Profile -->
                            <button @click="activeTab = 'profile'" 
                                    :class="activeTab === 'profile' ? 'bg-emerald-50/80 text-emerald-700 font-semibold border-emerald-500' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 border-transparent'"
                                    class="flex items-center gap-3 px-4 py-3.5 text-sm rounded-2xl transition-all duration-200 border-l-4 w-full text-left">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Informasi Profil</span>
                            </button>
                            
                            <!-- Tab: Password -->
                            <button @click="activeTab = 'password'" 
                                    :class="activeTab === 'password' ? 'bg-emerald-50/80 text-emerald-700 font-semibold border-emerald-500' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 border-transparent'"
                                    class="flex items-center gap-3 px-4 py-3.5 text-sm rounded-2xl transition-all duration-200 border-l-4 w-full text-left">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                <span>Ubah Kata Sandi</span>
                            </button>

                            <!-- Tab: Two Factor Auth -->
                            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <button @click="activeTab = 'two-factor'" 
                                    :class="activeTab === 'two-factor' ? 'bg-emerald-50/80 text-emerald-700 font-semibold border-emerald-500' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 border-transparent'"
                                    class="flex items-center gap-3 px-4 py-3.5 text-sm rounded-2xl transition-all duration-200 border-l-4 w-full text-left">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span>Otentikasi Ganda (2FA)</span>
                            </button>
                            @endif
                            
                            <!-- Tab: Browser Sessions -->
                            <button @click="activeTab = 'sessions'" 
                                    :class="activeTab === 'sessions' ? 'bg-emerald-50/80 text-emerald-700 font-semibold border-emerald-500' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 border-transparent'"
                                    class="flex items-center gap-3 px-4 py-3.5 text-sm rounded-2xl transition-all duration-200 border-l-4 w-full text-left">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Sesi Perangkat</span>
                            </button>

                            <!-- Tab: Danger Zone -->
                            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <button @click="activeTab = 'danger-zone'" 
                                    :class="activeTab === 'danger-zone' ? 'bg-red-50/80 text-red-700 font-semibold border-red-500' : 'text-gray-500 hover:bg-red-50/50 hover:text-red-700 border-transparent'"
                                    class="flex items-center gap-3 px-4 py-3.5 text-sm rounded-2xl transition-all duration-200 border-l-4 w-full text-left">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Hapus Akun</span>
                            </button>
                            @endif
                        </nav>
                    </div>
                    
                    <!-- Support Help Card (Forest Emerald Theme) -->
                    <div class="bg-gradient-to-br from-emerald-900 to-emerald-950 p-6 rounded-3xl text-white shadow-md relative overflow-hidden hidden lg:block">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full blur-2xl"></div>
                        <h4 class="font-bold text-base mb-2">Butuh Bantuan?</h4>
                        <p class="text-emerald-200/80 text-xs leading-relaxed mb-4">Jika Anda mengalami kendala keamanan atau kesalahan sistem pada akun Timbang Sapi Anda, silakan hubungi tim IT Administrator.</p>
                        <div class="flex items-center gap-2 text-emerald-300 text-xs font-semibold">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span>Support IT Timbang Sapi</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right Content (Tab Panels) -->
                <div class="lg:col-span-3">
                    
                    <!-- Tab Panel: Profile Info -->
                    <div x-show="activeTab === 'profile'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-6">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif
                    </div>
                    
                    <!-- Tab Panel: Password -->
                    <div x-show="activeTab === 'password'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-6"
                         style="display: none;">
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            @livewire('profile.update-password-form')
                        @endif
                    </div>
                    
                    <!-- Tab Panel: Two Factor -->
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div x-show="activeTab === 'two-factor'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-6"
                         style="display: none;">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                    @endif
                    
                    <!-- Tab Panel: Browser Sessions -->
                    <div x-show="activeTab === 'sessions'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-6"
                         style="display: none;">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>
                    
                    <!-- Tab Panel: Danger Zone -->
                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div x-show="activeTab === 'danger-zone'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-6"
                         style="display: none;">
                        @livewire('profile.delete-user-form')
                    </div>
                    @endif
                    
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
