<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="wellness-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-gradient-to-br from-green-500 to-teal-600 px-5 pt-8 pb-16 md:pb-20">
            <div class="flex items-center mb-5">
                <button onclick="window.location.href='<?= base_url('patient') ?>'"
                    class="p-2 -ml-1 bg-white/20 rounded-xl hover:bg-white/30 transition-all mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-base font-bold text-white">Wellness & Kesehatan</h1>
                    <p class="text-white/60 text-xs">Pantau kesehatanmu hari ini</p>
                </div>
            </div>
        </div>

        <div class="px-5 max-w-2xl mx-auto">

            <!-- Health Score Card -->
            <div class="-mt-8 mb-5">
                <div class="bg-white rounded-2xl shadow-md p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800 text-sm">Skor Kesehatan</h3>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">Hari ini</span>
                    </div>
                    <div class="flex items-center">
                        <div class="relative w-20 h-20 mr-5 flex-shrink-0">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#10b981" stroke-width="3"
                                    stroke-dasharray="75 25" stroke-linecap="round"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-xl font-bold text-gray-800">75</span>
                                <span class="text-xs text-gray-400">/ 100</span>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2.5">
                            <div>
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span class="font-medium">Aktivitas</span>
                                    <span class="font-bold text-blue-600">80%</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-blue-500 rounded-full transition-all" style="width:80%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span class="font-medium">Tidur</span>
                                    <span class="font-bold text-purple-600">65%</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-purple-500 rounded-full transition-all" style="width:65%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span class="font-medium">Hidrasi</span>
                                    <span class="font-bold text-teal-600">90%</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-teal-500 rounded-full transition-all" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="mb-5">
                <h3 class="font-bold text-gray-800 text-sm mb-3">Statistik Hari Ini</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-500">Detak Jantung</span>
                        </div>
                        <p class="text-xl font-bold text-gray-800">72 <span class="text-xs font-normal text-gray-400">bpm</span></p>
                        <span class="text-xs text-green-600 font-bold">Normal</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-500">Langkah Kaki</span>
                        </div>
                        <p class="text-xl font-bold text-gray-800">6.240 <span class="text-xs font-normal text-gray-400">/ 10k</span></p>
                        <span class="text-xs text-yellow-600 font-bold">62% target</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-teal-100 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-500">Air Minum</span>
                        </div>
                        <p class="text-xl font-bold text-gray-800">1,8 <span class="text-xs font-normal text-gray-400">/ 2L</span></p>
                        <span class="text-xs text-blue-600 font-bold">90% target</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-500">Tidur</span>
                        </div>
                        <p class="text-xl font-bold text-gray-800">6,5 <span class="text-xs font-normal text-gray-400">jam</span></p>
                        <span class="text-xs text-yellow-600 font-bold">Kurang ideal</span>
                    </div>
                </div>
            </div>

            <!-- Tips Kesehatan -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-gray-800 text-sm">Tips Kesehatan</h3>
                    <button class="text-xs text-green-600 font-bold hover:text-green-700">Lihat Semua</button>
                </div>
                <div class="space-y-3">
                    <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center space-x-3 cursor-pointer card-hover">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Jaga Kesehatan Jantung</h4>
                            <p class="text-xs text-gray-400 mt-0.5">5 tips mudah untuk menjaga kesehatan jantung</p>
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
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Manfaat Vitamin D</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Pentingnya sinar matahari pagi untuk tubuh sehat</p>
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
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">Pentingnya Hidrasi</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Cara mudah memenuhi kebutuhan air putih harian</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Reminders -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-gray-800 text-sm">Pengingat Hari Ini</h3>
                    <button class="text-xs text-green-600 font-bold bg-green-50 px-3 py-1.5 rounded-lg hover:bg-green-100 transition-all">+ Tambah</button>
                </div>
                <div class="space-y-3">
                    <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center">
                        <div class="w-9 h-9 bg-yellow-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Minum Obat</p>
                            <p class="text-xs text-gray-400">Paracetamol 500mg • 08:00, 14:00, 20:00</p>
                        </div>
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm flex items-center">
                        <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Minum Air Putih</p>
                            <p class="text-xs text-gray-400">Target 8 gelas per hari</p>
                        </div>
                        <div class="w-6 h-6 bg-gray-200 rounded-full flex-shrink-0"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
