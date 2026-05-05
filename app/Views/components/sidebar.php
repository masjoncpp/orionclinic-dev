<!-- Desktop Sidebar -->
<aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-100 h-full flex-shrink-0 z-40">

    <!-- Logo -->
    <div class="px-6 py-5 flex items-center border-b border-gray-100">
        <div class="w-20 h-20 bg-white-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
            <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-base font-bold text-gray-800 leading-tight">Orion Clinic</h1>
            <p class="text-xs text-gray-400">Telemedisin</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">

        <?php if(isset($role) && $role == 'doctor'): ?>

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Dokter</p>

            <button onclick="window.location.href='<?= base_url('doctor') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium text-sm">Dashboard</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="font-medium text-sm">Jadwal Konsultasi</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-medium text-sm">Data Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/chat') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <span class="font-medium text-sm">Chat Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="font-medium text-sm">Profil Dokter</span>
            </button>

        <?php else: ?>

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Utama</p>

            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium text-sm">Beranda</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <span class="font-medium text-sm">Konsultasi Dokter</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                <span class="font-medium text-sm">Resep & Obat</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="font-medium text-sm">Wellness</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium text-sm">Riwayat Kesehatan</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all group">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="font-medium text-sm">Profil Saya</span>
            </button>

        <?php endif; ?>
    </nav>

    <!-- Footer -->
    <div class="px-4 py-4 border-t border-gray-100">
        <button onclick="window.location.href='<?= base_url('logout') ?>'"
            class="w-full flex items-center space-x-3 px-3 py-2.5 text-red-500 rounded-xl hover:bg-red-50 transition-all">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span class="font-medium text-sm">Keluar</span>
        </button>
    </div>

</aside>
