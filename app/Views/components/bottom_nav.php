<!-- Mobile Bottom Navigation -->
<div id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 px-1 pt-2 pb-3 flex justify-around items-center md:hidden z-50">
    <?php if(isset($role) && $role == 'doctor'): ?>

        <button onclick="window.location.href='<?= base_url('doctor') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Jadwal</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Pasien</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Profil</span>
        </button>

    <?php else: ?>

        <button onclick="window.location.href='<?= base_url('patient') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Konsultasi</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Wellness</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-gray-400 hover:text-blue-600 transition-colors rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-xs mt-0.5 font-medium">Profil</span>
        </button>

    <?php endif; ?>
</div>
