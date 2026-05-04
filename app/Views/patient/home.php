<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="home-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-gradient-to-br from-blue-600 via-blue-600 to-blue-700 px-5 pt-8 pb-16 md:px-8 md:pt-10 md:pb-20">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <img src="<?= base_url('assets/profile.png') ?>" alt="Profile"
                            class="w-11 h-11 md:w-14 md:h-14 rounded-full mr-3 object-cover border-2 border-white/30">
                        <div>
                            <?php
                                $hour = date('H');
                                $greeting = ($hour >= 5 && $hour < 11) ? 'Selamat Pagi' : (($hour >= 11 && $hour < 15) ? 'Selamat Siang' : (($hour >= 15 && $hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));
                            ?>
                            <p class="text-white/70 text-xs md:text-sm"><?= $greeting ?> 👋</p>
                            <h2 class="text-white font-bold text-base md:text-xl"><?= esc(session()->get('name') ?? 'Pengguna') ?></h2>
                        </div>
                    </div>
                    <button class="relative p-2.5 bg-white/10 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-400 rounded-full border-2 border-blue-600"></span>
                    </button>
                </div>

                <!-- Search -->
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari dokter, layanan, atau obat..."
                        class="w-full pl-12 pr-4 py-3 md:py-3.5 bg-white rounded-2xl text-gray-800 text-sm shadow-lg shadow-blue-900/10 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-5 md:px-8">

            <!-- Quick Actions -->
            <div class="-mt-8 mb-6">
                <div class="bg-white rounded-2xl shadow-md shadow-gray-200/60 p-4 md:p-6">
                    <div class="grid grid-cols-4 gap-1 md:gap-3">

                        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-xl hover:bg-blue-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-blue-200 transition-all">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Konsultasi</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-xl hover:bg-teal-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-teal-200 transition-all">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Resep & Obat</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-xl hover:bg-green-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-green-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-green-200 transition-all">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Wellness</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-xl hover:bg-purple-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-purple-200 transition-all">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Riwayat</span>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Upcoming Appointment -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-gray-800 text-base md:text-lg">Jadwal Mendatang</h3>
                    <button class="text-sm text-blue-600 font-semibold hover:text-blue-700">Lihat Semua</button>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-5 md:p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white/20 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center mb-0.5">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 status-online"></span>
                                    <span class="text-xs text-green-300 font-medium">Online</span>
                                </div>
                                <h4 class="text-white font-bold text-sm md:text-base">Dr. Sarah Wijaya</h4>
                                <p class="text-white/60 text-xs">Dokter Umum • Hari ini, 14:00 WIB</p>
                            </div>
                        </div>
                        <button onclick="window.location.href='<?= base_url('patient/chat') ?>'"
                            class="bg-white text-blue-600 px-4 py-2 rounded-xl font-bold text-sm hover:bg-blue-50 transition-all flex-shrink-0">
                            Mulai Chat
                        </button>
                    </div>
                </div>
            </div>

            <!-- Desktop: two-column layout for bottom sections -->
            <div class="md:grid md:grid-cols-2 md:gap-6">

                <!-- Health Summary -->
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800 text-base md:text-lg">Ringkasan Kesehatan</h3>
                        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                            class="text-sm text-blue-600 font-semibold hover:text-blue-700">Detail</button>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-red-50 rounded-xl p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-red-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">Jantung</span>
                                </div>
                                <p class="text-lg font-bold text-gray-800">72 <span class="text-xs font-normal text-gray-400">bpm</span></p>
                                <span class="text-xs text-green-600 font-semibold">Normal</span>
                            </div>
                            <div class="bg-blue-50 rounded-xl p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">Langkah</span>
                                </div>
                                <p class="text-lg font-bold text-gray-800">6.240 <span class="text-xs font-normal text-gray-400">/ 10k</span></p>
                                <span class="text-xs text-yellow-600 font-semibold">62% target</span>
                            </div>
                            <div class="bg-teal-50 rounded-xl p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-teal-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">Air Minum</span>
                                </div>
                                <p class="text-lg font-bold text-gray-800">1,8 <span class="text-xs font-normal text-gray-400">/ 2L</span></p>
                                <span class="text-xs text-blue-600 font-semibold">90% target</span>
                            </div>
                            <div class="bg-purple-50 rounded-xl p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-purple-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">Tidur</span>
                                </div>
                                <p class="text-lg font-bold text-gray-800">6,5 <span class="text-xs font-normal text-gray-400">jam</span></p>
                                <span class="text-xs text-yellow-600 font-semibold">Kurang ideal</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Tips -->
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800 text-base md:text-lg">Tips Kesehatan</h3>
                        <button class="text-sm text-blue-600 font-semibold hover:text-blue-700">Lihat Semua</button>
                    </div>
                    <div class="space-y-3">
                        <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 text-sm">Jaga Kesehatan Jantung</h4>
                                <p class="text-xs text-gray-400 mt-0.5 truncate">5 tips mudah untuk jantung sehat</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 text-sm">Manfaat Vitamin D</h4>
                                <p class="text-xs text-gray-400 mt-0.5 truncate">Pentingnya sinar matahari pagi</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 text-sm">Pentingnya Hidrasi</h4>
                                <p class="text-xs text-gray-400 mt-0.5 truncate">Cara mudah memenuhi kebutuhan air</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
