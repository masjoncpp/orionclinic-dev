<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="doctor-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-white px-5 py-4 border-b border-gray-100 flex items-center sticky top-0 z-10 shadow-sm">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-xl hover:bg-gray-100 transition-all mr-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-gray-800">Konsultasi Dokter</h1>
        </div>

        <div class="max-w-5xl mx-auto">

            <!-- Specialization Filter -->
            <div class="px-5 py-4 bg-white border-b border-gray-50">
                <div class="flex space-x-2 overflow-x-auto pb-1 scrollbar-hide">
                    <button class="flex-shrink-0 px-4 py-1.5 bg-blue-600 text-white rounded-full text-sm font-semibold shadow-sm shadow-blue-200">Semua</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Umum</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Anak</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Jantung</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Kulit</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Gigi</button>
                </div>
            </div>

            <!-- Doctor List -->
            <div class="p-5 space-y-3 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4 md:space-y-0">

                <!-- Doctor Card 1 -->
                <div onclick="window.location.href='<?= base_url('patient/chat') ?>'"
                    class="bg-white rounded-2xl p-4 shadow-sm card-hover cursor-pointer border border-gray-50">
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-0.5">
                                <h4 class="font-bold text-gray-800 text-sm">Dr. Sarah Wijaya</h4>
                                <div class="flex items-center ml-2 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs text-gray-600 ml-1 font-semibold">4.9</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Dokter Umum</p>
                            <p class="text-xs text-gray-400 mt-0.5">10 tahun pengalaman</p>
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 status-online"></span>
                                    <span class="text-xs text-green-600 font-semibold">Online</span>
                                </div>
                                <span class="text-blue-600 font-bold text-sm">Rp 50.000</span>
                            </div>
                        </div>
                    </div>
                    <button onclick="event.stopPropagation(); window.location.href='<?= base_url('patient/chat') ?>'"
                        class="mt-3 w-full py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-700 transition-all">
                        Mulai Konsultasi
                    </button>
                </div>

                <!-- Doctor Card 2 -->
                <div onclick="window.location.href='<?= base_url('patient/chat') ?>'"
                    class="bg-white rounded-2xl p-4 shadow-sm card-hover cursor-pointer border border-gray-50">
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-teal-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-0.5">
                                <h4 class="font-bold text-gray-800 text-sm">Dr. Andi Pratama, Sp.A</h4>
                                <div class="flex items-center ml-2 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs text-gray-600 ml-1 font-semibold">4.8</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Spesialis Anak</p>
                            <p class="text-xs text-gray-400 mt-0.5">8 tahun pengalaman</p>
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 status-online"></span>
                                    <span class="text-xs text-green-600 font-semibold">Online</span>
                                </div>
                                <span class="text-blue-600 font-bold text-sm">Rp 100.000</span>
                            </div>
                        </div>
                    </div>
                    <button onclick="event.stopPropagation(); window.location.href='<?= base_url('patient/chat') ?>'"
                        class="mt-3 w-full py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-700 transition-all">
                        Mulai Konsultasi
                    </button>
                </div>

                <!-- Doctor Card 3 -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-50 opacity-80">
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-0.5">
                                <h4 class="font-bold text-gray-800 text-sm">Dr. Maya Sari, Sp.JP</h4>
                                <div class="flex items-center ml-2 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs text-gray-600 ml-1 font-semibold">4.9</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Spesialis Jantung</p>
                            <p class="text-xs text-gray-400 mt-0.5">15 tahun pengalaman</p>
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 bg-gray-300 rounded-full mr-1.5"></span>
                                    <span class="text-xs text-gray-400 font-semibold">Offline</span>
                                </div>
                                <span class="text-blue-600 font-bold text-sm">Rp 150.000</span>
                            </div>
                        </div>
                    </div>
                    <button disabled
                        class="mt-3 w-full py-2 bg-gray-100 text-gray-400 rounded-xl text-xs font-semibold cursor-not-allowed">
                        Tidak Tersedia
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
