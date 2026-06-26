<!-- Desktop Sidebar -->
<aside class="hidden md:flex flex-col w-64 bg-[#ffffff] border-r border-[#d3cec6] h-full flex-shrink-0 z-40">

    <!-- Logo -->
    <div class="px-6 py-5 flex items-center border-b border-[#d3cec6]">
        <div class="w-12 h-12 bg-white rounded-[8px] flex items-center justify-center mr-3 flex-shrink-0">
            <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-[16px] font-bold text-[#111111] leading-tight">Orion Clinic</h1>
            <p class="text-[12px] text-[#626260]">Telemedisin</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">

        <?php if(session()->get('role') == 'admin'): ?>
            <p class="text-[14px] font-medium text-[#7b7b78] px-3 mb-2">Menu Admin</p>

            <button onclick="window.location.href='<?= base_url('admin') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Dashboard</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/doctors') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="font-normal text-[14px]">Kelola Dokter</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/patients') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-normal text-[14px]">Kelola Pasien</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/specializations') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-normal text-[14px]">Spesialisasi</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/users') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('patient', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Semua Akun</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/transactions') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('receipt', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Keuangan</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/logs') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="font-normal text-[14px]">Audit Log</span>
            </button>

        <?php elseif(session()->get('role') == 'doctor'): ?>

            <p class="text-[14px] font-medium text-[#7b7b78] px-3 mb-2">Menu Dokter</p>

            <button onclick="window.location.href='<?= base_url('doctor') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Dashboard</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/schedules') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-normal text-[14px]">Atur Jadwal</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('appointments', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Jadwal Konsultasi</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('patient', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Data Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/chat') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('chat', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Chat Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('profile', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Profil Dokter</span>
            </button>

        <?php else: ?>

            <p class="text-[14px] font-medium text-[#7b7b78] px-3 mb-2">Menu Utama</p>

            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Beranda</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('appointments', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Konsultasi Dokter</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('prescription', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Resep & Obat</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('wellness', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Wellness</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('medical_records', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Riwayat Kesehatan</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/payments') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-normal text-[14px]">Riwayat Pembayaran</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
                class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('profile', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-normal text-[14px]">Profil Saya</span>
            </button>

        <?php endif; ?>
    </nav>

    <!-- Footer -->
    <div class="px-4 py-4 border-t border-[#d3cec6]">
        <button onclick="window.location.href='<?= base_url('logout') ?>'"
            class="w-full flex items-center space-x-3 px-3 py-2.5 text-[#c41c1c] rounded-[8px] hover:bg-[#f5f1ec] transition-all">
            <?= icon('logout', 20, 'w-5 h-5 flex-shrink-0') ?>
            <span class="font-medium text-[14px]">Keluar</span>
        </button>
    </div>

</aside>
