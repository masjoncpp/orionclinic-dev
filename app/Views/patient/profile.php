<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="profile-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Profile Header -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 px-5 pt-8 pb-20 md:pb-24">
            <h1 class="text-base font-bold text-white mb-5">Profil Saya</h1>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <img src="<?= base_url('assets/profile.png') ?>" alt="Profile"
                        class="w-16 h-16 rounded-2xl object-cover border-2 border-white/30">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white"><?= esc(session()->get('name') ?? 'Pengguna') ?></h2>
                    <p class="text-white/60 text-xs mt-0.5"><?= esc(session()->get('email') ?? '-') ?></p>
                    <p class="text-white/60 text-xs"><?= esc(session()->get('phone') ?? '-') ?></p>
                </div>
            </div>
        </div>

        <div class="px-5 max-w-2xl mx-auto">

            <!-- Family Members -->
            <div class="-mt-10 mb-5">
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800 text-sm">Anggota Keluarga</h3>
                        <button class="text-xs text-blue-600 font-bold bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition-all">+ Tambah</button>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-pink-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800 text-sm">Sari Santoso</h5>
                                <p class="text-xs text-gray-400">Istri • 35 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-purple-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800 text-sm">Anisa Santoso</h5>
                                <p class="text-xs text-gray-400">Anak • 8 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800 text-sm">Raka Santoso</h5>
                                <p class="text-xs text-gray-400">Anak • 5 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                <button class="w-full flex items-center p-4 hover:bg-gray-50 transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-gray-800 text-sm">Edit Profil</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-gray-50 transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-teal-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-gray-800 text-sm">Metode Pembayaran</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-gray-50 transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-gray-800 text-sm">Notifikasi</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-gray-50 transition-all">
                    <div class="w-9 h-9 bg-orange-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-gray-800 text-sm">Bantuan & FAQ</span>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Logout -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                <button onclick="window.location.href='<?= base_url('logout') ?>'"
                    class="w-full flex items-center p-4 hover:bg-red-50 transition-all">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-red-500 text-sm">Keluar dari Akun</span>
                </button>
            </div>

            <p class="text-center text-xs text-gray-300 mb-4">Orion Clinic v1.0.0</p>

        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
