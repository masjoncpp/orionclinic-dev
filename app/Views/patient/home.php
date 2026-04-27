<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="home-screen" class="flex flex-col h-full bg-gray-50">

            <div class="flex-1 overflow-auto pb-100"><!-- Header -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-b-3xl p-6 md:p-12 lg:p-16 xl:p-20 2xl:px-32">
                    <div class="flex items-center justify-between mb-6 md:mb-8">
                        <div class="flex items-center">
                            <img src="<?= base_url('assets/profile.png') ?>"  alt="Profile" class="w-12 h-12 md:w-20 md:h-20 lg:w-24 lg:h-24 rounded-full mr-3 md:mr-4 object-cover border-2 border-white/20">
                            <div>
                                <?php 
                                    $hour = date('H');
                                    $greeting = ($hour >= 5 && $hour < 11) ? 'Selamat Pagi' : (($hour >= 11 && $hour < 15) ? 'Selamat Siang' : (($hour >= 15 && $hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));
                                ?>
                                <p class="text-white/80 text-sm md:text-lg lg:text-xl"><?= $greeting ?> 👋</p>
                                <h2 class="text-white font-bold text-lg md:text-2xl lg:text-3xl xl:text-4xl"><?= esc(session()->get('name')) ?></h2>
                            </div>
                        </div><button class="relative p-2 md:p-4 lg:p-5 bg-white/10 rounded-full hover:bg-white/20 transition-all">
                            <svg class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg><span
                                class="absolute top-1 right-1 md:top-2 md:right-2 w-3 h-3 md:w-4 md:h-4 bg-red-500 rounded-full border-2 border-blue-600"></span>
                        </button>
                    </div><!-- Search Bar -->
                    <div class="relative">
                        <svg class="absolute left-4 md:left-6 top-1/2 transform -translate-y-1/2 w-5 h-5 md:w-7 md:h-7 text-gray-400"
                            fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg><input type="text" placeholder="Cari dokter, layanan, atau obat..."
                            class="w-full pl-12 md:pl-16 pr-4 md:pr-6 py-3.5 md:py-5 lg:py-6 bg-white rounded-xl md:rounded-2xl text-gray-800 shadow-lg shadow-blue-900/10 focus:outline-none focus:ring-2 focus:ring-white/50 text-base md:text-xl lg:text-2xl">
                    </div>
                </div><!-- Quick Actions -->

                <div class="px-6 md:px-12 lg:px-16 xl:px-20 2xl:px-32 -mt-8">
                    <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg shadow-gray-200/60 p-4 md:p-8 lg:p-10">
                        <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-8 gap-2 md:gap-4 lg:gap-6"><button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                                class="flex flex-col items-center p-3 md:p-5 lg:p-6 rounded-xl md:rounded-2xl hover:bg-blue-50 transition-all group">
                                <div
                                    class="w-12 h-12 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-blue-100 rounded-xl md:rounded-2xl flex items-center justify-center mb-2 md:mb-3 group-hover:bg-blue-200 transition-all">
                                    <svg class="w-6 h-6 md:w-10 md:h-10 lg:w-12 lg:h-12 text-blue-600" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div><span class="text-xs md:text-base lg:text-lg font-medium text-gray-700 text-center">Konsultasi</span>
                            </button> <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                                class="flex flex-col items-center p-3 md:p-5 lg:p-6 rounded-xl md:rounded-2xl hover:bg-teal-50 transition-all group">
                                <div
                                    class="w-12 h-12 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-teal-100 rounded-xl md:rounded-2xl flex items-center justify-center mb-2 md:mb-3 group-hover:bg-teal-200 transition-all">
                                    <svg class="w-6 h-6 md:w-10 md:h-10 lg:w-12 lg:h-12 text-teal-600" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div><span class="text-xs md:text-base lg:text-lg font-medium text-gray-700 text-center">Resep &amp;
                                    Obat</span>
                            </button> <button onclick="showScreen('wellness-screen')"
                                class="flex flex-col items-center p-3 md:p-5 lg:p-6 rounded-xl md:rounded-2xl hover:bg-green-50 transition-all group">
                                <div
                                    class="w-12 h-12 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-green-100 rounded-xl md:rounded-2xl flex items-center justify-center mb-2 md:mb-3 group-hover:bg-green-200 transition-all">
                                    <svg class="w-6 h-6 md:w-10 md:h-10 lg:w-12 lg:h-12 text-green-600" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div><span class="text-xs md:text-base lg:text-lg font-medium text-gray-700 text-center">Wellness</span>
                            </button> <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                                class="flex flex-col items-center p-6 rounded-xl hover:bg-purple-50 transition-all group">
                                <div
                                    class="w-12 h-12 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-purple-100 rounded-xl md:rounded-2xl flex items-center justify-center mb-2 md:mb-3 group-hover:bg-purple-200 transition-all">
                                    <svg class="w-6 h-6 md:w-10 md:h-10 lg:w-12 lg:h-12 text-purple-600" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                </div>
                                <span class="text-xs md:text-base lg:text-lg font-medium text-gray-700 text-center">Riwayat</span>
                            </button>
                        </div>
                    </div>
                </div><!-- Upcoming Appointment -->
                <div class="px-6 md:px-12 lg:px-16 xl:px-20 2xl:px-32 mt-8">
                    <div class="flex items-center justify-between mb-4 md:mb-6 max-w-7xl mx-auto">
                        <h3 class="font-bold text-gray-800 text-lg md:text-2xl lg:text-3xl md:ml-100">Jadwal Mendatang</h3><button
                            class="text-sm md:text-lg lg:text-xl text-blue-600 font-medium">Lihat Semua</button>
                    </div>
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl md:rounded-3xl p-5 md:p-8 lg:p-10 card-hover">
                        <div class="flex items-start justify-between mb-4 md:mb-6">
                            <div class="flex items-center">
                                <div class="w-14 h-14 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-white rounded-xl md:rounded-2xl flex items-center justify-center mr-4 md:mr-6">
                                    <svg class="w-8 h-8 md:w-12 md:h-12 lg:w-14 lg:h-14 text-blue-600" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-base md:text-xl lg:text-2xl">Dr. Sarah Wijaya</h4>
                                    <p class="text-white/70 text-sm md:text-lg lg:text-xl">Dokter Umum</p>
                                </div>
                            </div>
                            <div class="w-3 h-3 md:w-4 md:h-4 bg-green-400 rounded-full status-online"></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-white/90">
                                <svg class="w-4 h-4 md:w-6 md:h-6 lg:w-7 lg:h-7 mr-2 md:mr-3" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg><span class="text-sm md:text-lg lg:text-xl">Hari ini, 14:00 WIB</span>
                            </div><button onclick="showScreen('chat-screen')"
                                class="bg-white text-blue-600 px-4 py-2 md:px-8 md:py-4 lg:px-10 lg:py-5 rounded-lg md:rounded-xl font-semibold text-sm md:text-lg lg:text-xl hover:bg-blue-50 transition-all">
                                Mulai Chat </button>
                        </div>
                    </div>
                </div><!-- Health Tips -->
                <div class="px-6 md:px-12 lg:px-16 xl:px-20 2xl:px-32 mt-8">
                    <div class="flex items-center justify-between mb-4 md:mb-6 max-w-7xl mx-auto">
                        <h3 class="font-bold text-gray-800 text-lg md:text-2xl lg:text-3xl ml-5 md:ml-6">Tips Kesehatan</h3><button
                            class="text-sm md:text-lg lg:text-xl text-blue-600 font-medium">Lihat Semua</button>
                    </div>
                    <div class="flex space-x-4 overflow-x-auto pb-2 -mx-6 px-6 scrollbar-hide md:grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 md:gap-6 md:space-x-0 md:overflow-visible md:mx-0 md:px-0">
                        <div class="flex-shrink-0 w-64 md:w-full bg-white rounded-2xl md:rounded-3xl shadow-sm overflow-hidden card-hover">
                            <div
                                class="h-32 md:h-48 lg:h-56 bg-gradient-to-br from-teal-400 to-teal-500 flex items-center justify-center">
                                <svg class="w-16 h-16 md:w-24 md:h-24 lg:w-28 lg:h-28 text-white/80" fill="none" stroke="currentColor"
                                    viewbox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div class="p-4 md:p-6 lg:p-8">
                                <h4 class="font-semibold text-gray-800 mb-1 text-base md:text-xl lg:text-2xl">Jaga Kesehatan Jantung</h4>
                                <p class="text-sm md:text-lg lg:text-xl text-gray-500">5 tips mudah untuk jantung sehat</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-64 md:w-full bg-white rounded-2xl md:rounded-3xl shadow-sm overflow-hidden card-hover">
                            <div
                                class="h-32 md:h-48 lg:h-56 bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center">
                                <svg class="w-16 h-16 md:w-24 md:h-24 lg:w-28 lg:h-28 text-white/80" fill="none" stroke="currentColor"
                                    viewbox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="p-4 md:p-6 lg:p-8">
                                <h4 class="font-semibold text-gray-800 mb-1 text-base md:text-xl lg:text-2xl">Vitamin D Penting</h4>
                                <p class="text-sm md:text-lg lg:text-xl text-gray-500">Manfaat sinar matahari pagi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
