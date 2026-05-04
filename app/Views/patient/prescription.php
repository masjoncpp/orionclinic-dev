<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="prescription-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-white px-5 py-4 border-b border-gray-100 flex items-center sticky top-0 z-10 shadow-sm">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-xl hover:bg-gray-100 transition-all mr-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-gray-800">Resep & Obat</h1>
        </div>

        <!-- Tabs -->
        <div class="bg-white px-5 border-b border-gray-100">
            <div class="flex space-x-6">
                <button class="py-3 text-sm font-bold text-blue-600 border-b-2 border-blue-600">Resep Aktif</button>
                <button class="py-3 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors">Riwayat</button>
            </div>
        </div>

        <div class="p-5 max-w-2xl mx-auto">

            <!-- Prescription Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-4">

                <!-- Card Header -->
                <div class="p-4 border-b border-gray-50">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Aktif</span>
                        <span class="text-xs text-gray-400">15 Jan 2025</span>
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm">Resep dari Dr. Sarah Wijaya</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Konsultasi: Demam & Sakit Kepala</p>
                </div>

                <!-- Medicine List -->
                <div class="divide-y divide-gray-50">
                    <div class="p-4 flex items-center">
                        <div class="w-11 h-11 bg-teal-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-gray-800 text-sm">Paracetamol 500mg</h5>
                            <p class="text-xs text-gray-400">3x1 setelah makan</p>
                        </div>
                        <span class="text-sm font-bold text-gray-700">10 tablet</span>
                    </div>

                    <div class="p-4 flex items-center">
                        <div class="w-11 h-11 bg-orange-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-gray-800 text-sm">Vitamin C 500mg</h5>
                            <p class="text-xs text-gray-400">1x1 setelah makan</p>
                        </div>
                        <span class="text-sm font-bold text-gray-700">10 tablet</span>
                    </div>

                    <div class="p-4 flex items-center">
                        <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-gray-800 text-sm">Amoxicillin 250mg</h5>
                            <p class="text-xs text-gray-400">2x1 setelah makan</p>
                        </div>
                        <span class="text-sm font-bold text-gray-700">14 kapsul</span>
                    </div>
                </div>

                <!-- Total & Order -->
                <div class="p-4 bg-gray-50">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500 font-medium">Total Biaya Obat</span>
                        <span class="text-lg font-bold text-gray-800">Rp 45.000</span>
                    </div>
                    <button class="w-full btn-primary text-white py-3 rounded-xl font-bold text-sm">
                        Pesan Obat Sekarang
                    </button>
                </div>
            </div>

            <!-- Notes Card -->
            <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="font-semibold text-blue-800 text-sm mb-1">Catatan Dokter</h5>
                        <p class="text-xs text-blue-600">Minum obat sesuai anjuran. Istirahat cukup dan perbanyak minum air putih. Kontrol kembali jika gejala tidak membaik dalam 3 hari.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
